from django.db import models

# Create your models here.
from django.db import models
from django.utils import timezone
from django.core.exceptions import ValidationError

from django.db.models import Sum


class CompteHebdomadaire(models.Model):
    numero = models.CharField(max_length=50)
    designation = models.CharField(max_length=255)
    valeur = models.DecimalField(max_digits=12, decimal_places=2, default=0)
    total = models.DecimalField(max_digits=12, decimal_places=2, default=0)
    date_debut = models.DateField(blank=True, null=True)
    date_fin = models.DateField(blank=True, null=True)

    def __str__(self):
        return f"{self.numero} - {self.designation}"

    def mettre_a_jour_total(self):
  

        total_tickets = sum(
            t.montant_journalier * t.jours_verse
            for t in Ticket.objects.filter(date_debut__gte=self.date_debut, date_debut__lte=self.date_fin)
        )

        total_debits = CompteDebit.objects.filter(
            date__gte=self.date_debut, date__lte=self.date_fin
        ).aggregate(total=Sum("solde"))["total"] or 0

        total_valeurs = ValeurAjoutee.objects.aggregate(total=Sum("valeur"))["total"] or 0

        self.total = total_valeurs - total_tickets - total_debits
        # pas de self.save() ici !
        return self.total

    def save(self, *args, **kwargs):
        self.mettre_a_jour_total()
        super().save(*args, **kwargs)



class ValeurAjoutee(models.Model):
    numero = models.CharField(max_length=50)
    designation = models.CharField(max_length=255)
    valeur = models.DecimalField(max_digits=12, decimal_places=0)
    date = models.DateField(auto_now_add=True)

    def __str__(self):
        return f"{self.numero} - {self.designation} ({self.valeur})"



class CompteCredit(models.Model):
    date = models.DateField()
    nom = models.CharField(max_length=255)
    solde = models.DecimalField(max_digits=12, decimal_places=0)
    observation = models.TextField(blank=True, null=True)

    def __str__(self):
        return f"-{self.nom} : {self.solde}"


class CompteDebit(models.Model):
    date = models.DateField()
    nom = models.CharField(max_length=255)
    solde = models.DecimalField(max_digits=12, decimal_places=0)
    observation = models.TextField(blank=True, null=True)
    # echap = models.TextField(blank=True, null=True)

    def __str__(self):
        return f"- {self.nom} : {self.solde}"

class Operation(models.Model):
    date = models.DateField()
    libelle = models.CharField(max_length=255)
    montant = models.DecimalField(max_digits=12, decimal_places=2)
    Observation = models.CharField(max_length=255)

    def __str__(self):
        return f"{self.libelle} : {self.montant} GNF"


class Ticket(models.Model):
    client = models.CharField(max_length=255)
    photo = models.ImageField(upload_to='tickets/', blank=True, null=True)
    montant_journalier = models.DecimalField(max_digits=12, decimal_places=0)
    nombre_jours_total = models.PositiveIntegerField(default=31)
    jours_verse = models.PositiveIntegerField(default=0)
    date_debut = models.DateField(default=timezone.now)
    encours = models.BooleanField(default=True)  # True si ticket actif
    retrait_effectue = models.BooleanField(default=False)

    def __str__(self):
        return f"{self.client} - {self.montant_journalier} GNF/jour"

    @property
    def total_verse(self):
        """Total versé jusqu'à présent"""
        return self.montant_journalier * self.jours_verse

    @property
    def total_retirable(self):
        """Total que le client peut retirer"""
        if self.jours_verse >= 2 and not self.retrait_effectue:
            return self.total_verse - self.montant_journalier  # 1 jour pour le caissier
        return 0

    def ajouter_jour(self):
        """Ajouter un versement journalier"""
        if self.jours_verse < self.nombre_jours_total:
            self.jours_verse += 1
            if self.jours_verse == self.nombre_jours_total:
                self.encours = False  # clôture le ticket après le dernier versement
            self.save()

    def retirer(self):
        if self.jours_verse < 2:
            raise ValidationError("Le retrait n'est possible qu'après avoir versé au moins 2 jours.")
        if self.retrait_effectue:
            raise ValidationError("Retrait déjà effectué.")
        
        self.retrait_effectue = True
        self.save()
        return self.total_verse
    

class TicketRetire(models.Model):
    client = models.CharField(max_length=255)
    photo = models.ImageField(upload_to='tickets/', blank=True, null=True)
    montant_journalier = models.DecimalField(max_digits=12, decimal_places=0)
    nombre_jours_total = models.PositiveIntegerField(default=31)
    jours_verse = models.PositiveIntegerField(default=0)
    date_debut = models.DateField()
    date_retrait = models.DateTimeField(default=timezone.now)
    total_retiré = models.DecimalField(max_digits=12, decimal_places=0)

    def __str__(self):
        return f"{self.client} - Retiré {self.total_retiré} GNF"
    


    # finance/models.py
from django.contrib.auth.models import AbstractUser

from django.contrib.auth.models import AbstractUser, Group, Permission
from django.db import models

class Administrateur(AbstractUser):
    FONCTION_CHOICES = [
        ('SUPER', 'Super Utilisateur'),
        ('USER', 'Utilisateur'),
    ]
    fonction = models.CharField(max_length=20, choices=FONCTION_CHOICES, default='USER')
    photo = models.ImageField(upload_to='photos/', blank=True, null=True)

    # 👇 éviter le conflit avec auth.User
    groups = models.ManyToManyField(
        Group,
        related_name='administrateur_set',  # change ici
        blank=True,
        help_text='The groups this user belongs to.',
        verbose_name='groups',
    )
    user_permissions = models.ManyToManyField(
        Permission,
        related_name='administrateur_permissions_set',  # change ici
        blank=True,
        help_text='Specific permissions for this user.',
        verbose_name='user permissions',
    )

    def __str__(self):
        return self.username


