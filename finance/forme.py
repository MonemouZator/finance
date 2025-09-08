# finance/forms.py
from django import forms
from django.contrib.auth.forms import UserCreationForm
from .models import Administrateur

class AdministrateurRegisterForm(UserCreationForm):
    # On peut personnaliser l'apparence ou labels ici si besoin
    class Meta:
        model = Administrateur
        fields = ['username', 'email', 'fonction', 'photo', 'password1', 'password2']
        labels = {
            'username': 'Nom d’utilisateur',
            'email': 'Adresse Email',
            'fonction': 'Fonction',
            'photo': 'Photo de Profil',
            'password1': 'Mot de passe',
            'password2': 'Confirmation du mot de passe',
        }

    # Exemple : validation custom pour email unique
    def clean_email(self):
        email = self.cleaned_data.get('email')
        if Administrateur.objects.filter(email=email).exists():
            raise forms.ValidationError("Cette adresse email est déjà utilisée.")
        return email
