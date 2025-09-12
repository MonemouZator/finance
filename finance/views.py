from django.shortcuts import render, redirect, get_object_or_404
from django.contrib import messages
from decimal import Decimal
from django.db.models import Sum
from django.utils import timezone
from datetime import datetime
from django.contrib.auth import authenticate, login,logout
from django.core.exceptions import ValidationError
from .models import ValeurAjoutee, Operation, CompteCredit, CompteDebit,TicketRetire,CompteHebdomadaire,TicketCredit
from finance.models import Administrateur


def page_accueil(request):

    # Total valeurs ajoutées
    total_valeurs = ValeurAjoutee.objects.aggregate(total=Sum('valeur'))['total'] or 0

    # Total crédits
    total_credit = CompteCredit.objects.aggregate(total=Sum('solde'))['total'] or 0

    # Total débits
    total_debit = CompteDebit.objects.aggregate(total=Sum('solde'))['total'] or 0

    # Total tickets (versements)
    total_tickets = sum(t.total_verse for t in Ticket.objects.all())

    # Pour les graphiques : labels et valeurs
    labels_debit = list(CompteDebit.objects.values_list('nom', flat=True))
    data_debit = list(CompteDebit.objects.values_list('solde', flat=True))

    labels_credit = list(CompteCredit.objects.values_list('nom', flat=True))
    data_credit = list(CompteCredit.objects.values_list('solde', flat=True))

    context = {
        'montant_tickets': total_tickets,
        'montant_credit': total_credit,
        'montant_debit': total_debit,
        'montant_valeurs': total_valeurs,
        'labels_debit': labels_debit,
        'data_debit': data_debit,
        'labels_credit': labels_credit,
        'data_credit': data_credit,
    }

    return render(request, 'base/index.html', context)


 

# ---------------- VALEURS AJOUTÉES ----------------
from django.db.models import Sum

def page_valeur_ajouter(request):
    valeres = ValeurAjoutee.objects.all()

    date_debut = request.GET.get('date_debut')
    date_fin = request.GET.get('date_fin')

    # Si les deux dates existent → filtrer
    if date_debut and date_fin:
        valeres = valeres.filter(date__range=[date_debut, date_fin])

    total_general = valeres.aggregate(Sum('valeur'))['valeur__sum'] or 0

    context = {
        'valeres': valeres,
        'total_general': total_general,
        'date_debut': date_debut,
        'date_fin': date_fin,
    }
    return render(request, 'base/pages/tables/data.html', context)

def ajout_valeur(request):
    if request.method == 'POST':
        numero = request.POST.get('numero')
        designation = request.POST.get('designation')
        montant = request.POST.get('valeur')
        if numero and designation and montant:
            try:
                montant_decimal = Decimal(montant)
                ValeurAjoutee.objects.create(
                    numero=numero,
                    designation=designation,
                    valeur=montant_decimal
                )
                messages.success(request, "Valeur ajoutée avec succès !")
            except:
                messages.error(request, "Montant invalide.")
        else:
            messages.error(request, "Tous les champs doivent être remplis.")
    return redirect('valeur-ajouter')

def modifier_valeur(request, pk):
    val = get_object_or_404(ValeurAjoutee, id=pk)
    if request.method == 'POST':
        val.numero = request.POST.get('numero')
        val.designation = request.POST.get('designation')
        val.valeur = request.POST.get('valeur')
        val.save()
        messages.success(request, "Valeur modifiée avec succès !")
    return redirect('valeur-ajouter')

def supprimer_valeur(request, pk):
    val = get_object_or_404(ValeurAjoutee, id=pk)
    val.delete()
    messages.success(request, "Valeur supprimée avec succès !")
    return redirect('valeur-ajouter')


# ---------------- CHARGES ----------------
def charge_effectue(request):
    date_debut = request.GET.get('date_debut')
    date_fin = request.GET.get('date_fin')

    charges = Operation.objects.all()

    # Filtrage si dates renseignées
    if date_debut and date_fin:
        charges = charges.filter(date__gte=date_debut, date__lte=date_fin)

    total_general = charges.aggregate(Sum('montant'))['montant__sum'] or 0

    context = {
        'charges': charges,
        'total_general': total_general,
        'date_debut': date_debut,
        'date_fin': date_fin
    }
    return render(request, 'base/charge.html', context)

def ajout_charge(request):
    if request.method == 'POST':
        # Vérifier le nombre de charges existantes
        nb_charges = Operation.objects.count()
        if nb_charges >= 10:
            messages.error(request, "Impossible d'ajouter une nouvelle charge : le nombre de charges a atteint 15.")
            return redirect('charge')

        # Création de la charge
        Operation.objects.create(
            date=request.POST.get('date'),
            libelle=request.POST.get('lebelle'),   # attention à l'orthographe "libelle"
            montant=request.POST.get('solde'),
            Observation=request.POST.get('observe'),
        )
        messages.success(request, "Charge ajoutée avec succès !")
    
    return redirect('charge')



def modifier_charge(request, pk):
    charge = get_object_or_404(Operation, id=pk)
    if request.method == 'POST':
        charge.date = request.POST.get('date')
        charge.libelle = request.POST.get('lebelle')
        charge.montant = request.POST.get('solde')
        charge.Observation = request.POST.get('observe')
        charge.save()
        messages.success(request, "Charge modifiée avec succès !")
    return redirect('charge')


def supprimer_charge(request, pk):
    charge = get_object_or_404(Operation, id=pk)
    charge.delete()
    messages.success(request, "Charge supprimée avec succès !")
    return redirect('charge')

# ---------------- COMPTE CREDIT ----------------
# def compte_credit(request):
#     credits = CompteCredit.objects.all()
#     return render(request, 'base/compte_credit.html', {'credits': credits})

# ---------------- COMPTE CREDIT ----------------
def compte_credit(request):
    credits = CompteCredit.objects.all()
    total_general = credits.aggregate(total=Sum('solde'))['total'] or 0
    return render(request, 'base/compte_credit.html', {
        'credits': credits,
        'total_general': total_general
    })


def ajout_compte_credit(request):
    if request.method == 'POST':
        # Vérifier le nombre de comptes crédit
        nb_credits = CompteCredit.objects.count()
        if nb_credits >= 15:
            messages.error(request, "Impossible d'ajouter un nouveau compte : le nombre de comptes crédit a atteint 15.")
            return redirect('credit')

        nom = request.POST.get('nom')
        date = request.POST.get('date')
        solde = request.POST.get('solde')
        observation = request.POST.get('observation')

        if nom and date and solde:
            CompteCredit.objects.create(
                nom=nom,
                date=date,
                solde=solde,
                observation=observation
            )
            messages.success(request, "Crédit ajouté avec succès !")
        else:
            messages.error(request, "Tous les champs obligatoires doivent être remplis.")
    
    return redirect('credit')

def modifier_compte_credit(request, pk):
    credit = get_object_or_404(CompteCredit, id=pk)
    if request.method == 'POST':
        credit.nom = request.POST.get('nom')
        credit.date = request.POST.get('date')
        credit.solde = request.POST.get('solde')
        credit.observation = request.POST.get('observation')
        credit.save()
        messages.success(request, "Crédit modifié avec succès !")
    return redirect('credit')

def supprimer_compte_credit(request, pk):
    credit = get_object_or_404(CompteCredit, id=pk)
    credit.delete()
    messages.success(request, "Crédit supprimé avec succès !")
    return redirect('credit')


# ---------------- COMPTE DEBIT ----------------
def compte_debit(request):
    debits = CompteDebit.objects.all()
    total_general = debits.aggregate(total=Sum('solde'))['total'] or 0
    return render(request, 'base/compte_debit.html', {
        'debits': debits,
        'total_general': total_general
    })


def ajout_compte_debit(request):
    if request.method == 'POST':
        # Vérifier le nombre de comptes débit
        nb_debits = CompteDebit.objects.count()
        if nb_debits >= 15:
            messages.error(request, "Impossible d'ajouter un nouveau compte : le nombre de comptes débit a atteint 15.")
            return redirect('debit')

        nom = request.POST.get('nom')
        date = request.POST.get('date')
        solde = request.POST.get('solde')
        observation = request.POST.get('observation')

        if nom and date and solde:
            CompteDebit.objects.create(
                nom=nom,
                date=date,
                solde=solde,
                observation=observation
            )
            messages.success(request, "Débit ajouté avec succès !")
        else:
            messages.error(request, "Tous les champs obligatoires doivent être remplis.")
    
    return redirect('debit')


def modifier_compte_debit(request, pk):
    debit = get_object_or_404(CompteDebit, id=pk)
    if request.method == 'POST':
        debit.nom = request.POST.get('nom')
        debit.date = request.POST.get('date')
        debit.solde = request.POST.get('solde')
        debit.observation = request.POST.get('observation')
        debit.save()
        messages.success(request, "Débit modifié avec succès !")
    return redirect('debit')

def supprimer_compte_debit(request, pk):
    debit = get_object_or_404(CompteDebit, id=pk)
    debit.delete()
    messages.success(request, "Débit supprimé avec succès !")
    return redirect('debit')

# Afficher tous les tickets
from django.core.paginator import Paginator
from django.db.models import Q

def liste_tickets(request):
    query = request.GET.get('q', '')  # récupérer le texte de recherche
    
    # Filtrage si recherche
    tickets_list = Ticket.objects.all().order_by('-id')
    if query:
        tickets_list = tickets_list.filter(
            Q(client__icontains=query) | Q(id__icontains=query)
        )

    # Pagination
    paginator = Paginator(tickets_list, 10)  # 10 tickets par page
    page_number = request.GET.get('page')
    tickets = paginator.get_page(page_number)

    # Totaux calculés sur la liste filtrée (pas seulement la page affichée)
    total_verse = sum(t.total_verse for t in tickets_list)
    total_retirable = sum(t.total_retirable for t in tickets_list)
    total_commission = sum(t.montant_journalier for t in tickets_list if t.jours_verse > 0)

    jours = list(range(1, 32))

    context = {
        'tickets': tickets,
        'total_verse': total_verse,
        'total_retirable': total_retirable,
        'total_commission': total_commission,
        'jours_ligne1': jours[0:11],
        'jours_ligne2': jours[11:21],
        'jours_ligne3': jours[21:31],
        'query': query,  # pour garder la recherche dans l’input
    }
    return render(request, 'base/ticket.html', context)


# Ajouter un ticket
def ajout_ticket(request):
    if request.method == 'POST':
        client = request.POST.get('client')
        montant_journalier = request.POST.get('montant_journalier')
        photo = request.FILES.get('photo')
        
        if client and montant_journalier:
            Ticket.objects.create(
                client=client,
                montant_journalier=montant_journalier,
                photo=photo
            )
            messages.success(request, "Ticket ajouté avec succès !")
        else:
            messages.error(request, "Veuillez remplir tous les champs obligatoires.")
    
    return redirect('liste_tickets')

# Modifier un ticket
def modifier_ticket(request, pk):
    ticket = get_object_or_404(Ticket, id=pk)
    if request.method == 'POST':
        ticket.client = request.POST.get('client')
        ticket.montant_journalier = request.POST.get('montant_journalier')
        if request.FILES.get('photo'):
            ticket.photo = request.FILES.get('photo')
        ticket.save()
        messages.success(request, "Ticket modifié avec succès !")
    return redirect('liste_tickets')

# Supprimer un ticket
def supprimer_ticket(request, pk):
    ticket = get_object_or_404(Ticket, id=pk)
    ticket.delete()
    messages.success(request, "Ticket supprimé avec succès !")
    return redirect('liste_tickets')

# Ajouter un versement journalier
def ajouter_jour_ticket(request, pk):
    ticket = get_object_or_404(Ticket, id=pk)
    try:
        ticket.ajouter_jour()
        messages.success(request, f"Versement ajouté pour {ticket.client} !")
    except Exception as e:
        messages.error(request, str(e))
    return redirect('liste_tickets')


from django.shortcuts import get_object_or_404, redirect
from django.contrib import messages
from .models import Ticket, TicketRetire

def retirer_ticket(request, pk):
    ticket = get_object_or_404(Ticket, id=pk)

    if ticket.jours_verse < 2:
        messages.error(request, "Le retrait n'est possible qu'après avoir versé au moins 2 jours.")
        return redirect('liste_tickets')

    if request.method == "POST":
        # Créer le ticket retiré
        TicketRetire.objects.create(
            client=ticket.client,
            photo=ticket.photo,
            montant_journalier=ticket.montant_journalier,
            nombre_jours_total=ticket.nombre_jours_total,
            jours_verse=ticket.jours_verse,
            date_debut=ticket.date_debut,
            total_retiré=ticket.total_verse,
            total_credit=ticket.total_credit
        )
        ticket.delete()
        messages.success(request, f"{ticket.client} a retiré {ticket.total_verse} GNF !")
        return redirect('liste_tickets')
    
    # Si accès direct GET, rediriger vers la liste
    return redirect('liste_tickets')






def impression_tickets(request):
    tickets = Ticket.objects.all()
    
    # On crée les listes de jours pour chaque ligne
    jours_ligne1 = list(range(1, 12))   # Jours 1 à 11
    jours_ligne2 = list(range(12, 23))  # Jours 12 à 21
    jours_ligne3 = list(range(23, 32))  # Jours 22 à 31

    return render(request, 'base/impression_tickets.html', {
        'tickets': tickets,
        'jours_ligne1': jours_ligne1,
        'jours_ligne2': jours_ligne2,
        'jours_ligne3': jours_ligne3,
    })



def liste_tickets_retire(request):
    tickets_retire = TicketRetire.objects.all().order_by('-date_retrait')

    total_general = Decimal("0.00")
    total_commission = Decimal("0.00")
    commission_taux = Decimal("1")  # 1 jour = 100%

    # Préparer la liste avec total_apres_commission et commission
    tickets_data = []
    for t in tickets_retire:
        commission = t.montant_journalier  # 1 jour comme commission
        total_apres_commission = t.total_retiré - commission

        total_general += total_apres_commission
        total_commission += commission

        tickets_data.append({
            "ticket": t,
            "total_apres_commission": total_apres_commission,
            "commission": commission,
        })

    context = {
        "tickets_retire": tickets_data,
        "total_general": total_general,
        "total_commission": total_commission,
        "commission_taux": commission_taux * 100,  # affichage dans template
    }
    return render(request, "base/ticket_retire.html", context)


from decimal import Decimal, InvalidOperation

def ajouter_credit(request, ticket_id):
    ticket = get_object_or_404(Ticket, id=ticket_id)

    if request.method == "POST":
        try:
            montant = Decimal(request.POST.get("montant", "0"))
        except (InvalidOperation, TypeError):
            messages.error(request, "Montant invalide.")
            return redirect("liste_tickets")

        total_verse = ticket.total_verse or Decimal("0")

        # Vérifier si un crédit existe déjà
        if TicketCredit.objects.filter(ticket=ticket).exists():
            messages.error(request, f"Un crédit existe déjà pour {ticket.client}.")
            return redirect("liste_tickets")

        if montant <= 0:
            messages.error(request, "Le montant doit être supérieur à 0.")
        elif montant > (total_verse / 2):
            messages.error(
                request,
                f"Le montant du crédit ne peut pas dépasser la moitié du total versé ({total_verse/2} GNF)."
            )
        else:
            TicketCredit.objects.create(ticket=ticket, montant=montant)
            messages.success(request, f"Crédit de {montant} GNF ajouté pour {ticket.client}.")

    return redirect("liste_tickets")



def liste_clients_credit(request):
    query = request.GET.get('q', '')

    # Tous les tickets actifs (encours=True) qui ont un crédit
    tickets_qs = Ticket.objects.filter(encours=True).prefetch_related('credits')

    tickets_data = []
    total_credit_general = Decimal("0.00")

    for ticket in tickets_qs:
        # Calcul du crédit actif
        credit_actif = ticket.total_credit
        if credit_actif > 0:
            if query and query.lower() not in ticket.client.lower():
                continue
            tickets_data.append({
                'ticket': ticket,
                'credit_actif': credit_actif
            })
            total_credit_general += credit_actif

    # Pagination
    paginator = Paginator(tickets_data, 10)
    page_number = request.GET.get('page')
    tickets_page = paginator.get_page(page_number)

    context = {
        'tickets_page': tickets_page,
        'query': query,
        'total_credit_general': total_credit_general,
    }
    return render(request, 'base/clients_credit.html', context)



def creer_compte_hebdo(request):
    if request.method == "POST":
        numero = request.POST.get("numero")
        designation = request.POST.get("designation")
        valeur = float(request.POST.get("valeur") or 0)
        date_debut = request.POST.get("date_debut")
        date_fin = request.POST.get("date_fin")

        # Création du compte hebdomadaire
        CompteHebdomadaire.objects.create(
            numero=numero,
            designation=designation,
            valeur=valeur,
            date_debut=date_debut,
            date_fin=date_fin
        )

        messages.success(request, "Compte Hebdomadaire créé avec succès.")
        return redirect("liste_compte_hebdo")

    # Si GET sur cette URL, redirige vers la liste
    return redirect("liste_compte_hebdo")



from .models import CompteHebdomadaire, Ticket, CompteDebit, CompteCredit

def liste_compte_hebdo(request):
    # Récupération des filtres
    date_debut = request.GET.get("date_debut")
    date_fin = request.GET.get("date_fin")

    # Filtrage des comptes hebdomadaires
    comptes = CompteHebdomadaire.objects.all()
    if date_debut and date_fin:
        comptes = comptes.filter(date_debut__gte=date_debut, date_fin__lte=date_fin)

    # Total Valeurs (lié aux comptes affichés)
    total_valeurs = comptes.aggregate(total=Sum("valeur"))["total"] or 0

    # Total Tickets (négatif)
    total_tickets = sum(t.montant_journalier * t.jours_verse for t in Ticket.objects.all()) or 0
    total_tickets = -total_tickets

    # Total Débits (négatif, filtrés si besoin)
    debits = CompteDebit.objects.all()
    if date_debut and date_fin:
        debits = debits.filter(date__gte=date_debut, date__lte=date_fin)
    total_debits = debits.aggregate(total=Sum("solde"))["total"] or 0
    total_debits = -total_debits

    # Total Crédits (positif, filtrés si besoin)
    credits = CompteCredit.objects.all()
    if date_debut and date_fin:
        credits = credits.filter(date__gte=date_debut, date__lte=date_fin)
    total_credits = credits.aggregate(total=Sum("solde"))["total"] or 0

    # Total général
    total_general = total_valeurs + total_tickets + total_debits + total_credits

    return render(request, "base/liste_compte_hebdo.html", {
        "comptes": comptes,
        "total_valeurs": total_valeurs,
        "total_tickets": total_tickets,
        "total_debits": total_debits,
        "total_credits": total_credits,
        "total_general": total_general,
        "date_debut": date_debut,
        "date_fin": date_fin,
    })



# CONNEXION
def login_view(request):
    if request.method == 'POST':
        username = request.POST.get('username')
        password = request.POST.get('password')

        if not username or not password:
            messages.error(request, "Veuillez entrer votre login et mot de passe.")
            return redirect('page_connexion')

        user = authenticate(request, username=username, password=password)

        if user is not None:
            login(request, user)
            messages.success(request, "Bienvenue, vous êtes connecté avec succès.")
            return redirect('page_acceil')  #  Vérifie que ce nom existe dans urls.py

            # 🔽 Redirection après login réussi
            return redirect('page_accueil')  # change selon ton projet (dashboard, accueil, etc.)
        else:
            messages.error(request, "Login ou mot de passe incorrect.")
            return redirect('page_connexion')

    return render(request, 'base/login.html')


# DECONNEXION
def logout_view(request):
    logout(request)
    messages.info(request, "Vous êtes déconnecté.")
    return redirect('page_connexion')  # redirige vers login




from django.contrib import messages
from django.db import IntegrityError
from django.shortcuts import render, redirect
from .models import Administrateur

def ajout_administrateur(request):
    if request.method == "POST":
        username = request.POST.get("username", "").strip()
        email = request.POST.get("email", "").strip().lower()
        password = request.POST.get("password", "").strip()
        nom = request.POST.get("nom", "").strip()
        prenom = request.POST.get("prenom", "").strip()
        telephone = request.POST.get("telephone", "").strip()
        genre = request.POST.get("genre", "")
        date_naissance = request.POST.get("date_naissance", "")
        lieu_naiss = request.POST.get("lieu_naiss", "").strip()
        fonction = request.POST.get("fonction", "")
        photo = request.FILES.get("photo")

        # ✅ Vérifier si des champs obligatoires sont manquants
        if not all([username, email, password, nom, prenom, telephone]):
            messages.error(request, "Tous les champs obligatoires doivent être remplis.")
            return redirect("ajouter_administrateur")

        # ✅ Vérification unicité
        if Administrateur.objects.filter(email=email).exists():
            messages.error(request, "Cet email est déjà utilisé.")
            return redirect("ajouter_administrateur")

        if Administrateur.objects.filter(username=username).exists():
            messages.error(request, "Cet identifiant existe déjà dans la base.")
            return redirect("ajouter_administrateur")

        if Administrateur.objects.filter(telephone=telephone).exists():
            messages.error(request, "Ce numéro de téléphone est déjà utilisé.")
            return redirect("ajouter_administrateur")

        try:
            administrateur = Administrateur.objects.create(
                username=username,
                email=email,
                nom=nom,
                prenom=prenom,
                telephone=telephone,
                genre=genre,
                date_naissance=date_naissance or None,
                lieu_naiss=lieu_naiss,
                fonction=fonction,
                photo=photo,
            )
            administrateur.set_password(password)  # ✅ hachage du mot de passe
            administrateur.save()

            messages.success(request, "Compte créé avec succès !")
            return redirect("ajouter_administrateur")

        except IntegrityError:
            messages.error(request, "Erreur d’intégrité dans la base de données.")
        except Exception as e:
            print("Erreur :", e)
            messages.error(request, f"Erreur lors de l'ajout : {e}")

    return render(request, 'base/ajouter_administrateur.html')


#PROFIL ET CHANGEMENTS DES INFORMATION DE L'UTILISATEUR CONNECTER

def profil_user(request):
    user = request.user

    if request.method == "POST":
        user.nom = request.POST.get("nom", user.nom).strip()
        user.prenom = request.POST.get("prenom", user.prenom).strip()
        user.email = request.POST.get("email", user.email).strip().lower()
        user.genre = request.POST.get("sexe", user.genre)
        user.telephone = request.POST.get("contact", user.telephone).strip()
        user.lieu_naiss = request.POST.get("filiation", user.lieu_naiss).strip()

        date_str = request.POST.get("date")
        if date_str:
            try:
                user.date_naissance = datetime.strptime(date_str, "%Y-%m-%d").date()
            except ValueError:
                messages.error(request, "Format de date invalide.")

        if "photo" in request.FILES:
            user.photo = request.FILES["photo"]

        user.save()
        messages.success(request, "Votre profil a été mis à jour avec succès.")
        return redirect("profil")

    return render(request, "base/profil.html")



#FONCTION DE CHANGEMENT DE MOT DE PASSE DE L'UTILISATEUR COURANT

from django.contrib.auth.decorators import login_required



@login_required
def change_password(request):
    if request.method == "POST":
        password = request.POST.get('password')
        confirm_password = request.POST.get('cpwd')
        auto_login = request.POST.get('connect')  # checkbox pour rester connecté

        # Vérifications côté serveur
        if not password or not confirm_password:
            messages.error(request, "Veuillez remplir tous les champs.")
            return redirect('change_password')

        if password != confirm_password:
            messages.error(request, "Les mots de passe ne sont pas identiques.")
            return redirect('change_password')

        if len(password) < 6:
            messages.error(request, "Le mot de passe doit contenir au moins 6 caractères.")
            return redirect('change_password')

        # Changement du mot de passe
        user = request.user
        user.set_password(password)
        user.save()

        # Option : reconnecter l'utilisateur
        if auto_login == "on":
            user = authenticate(username=user.username, password=password)
            if user is not None:
                login(request, user)
            messages.success(request, "Mot de passe changé avec succès, vous êtes reconnecté !")
            return redirect('profil')
        else:
            logout(request)
            messages.success(request, "Mot de passe changé, veuillez vous reconnecter.")
            return redirect('page_connexion')

    return render(request, 'base/recover_password.html')
