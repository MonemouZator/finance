# # finance/admin.py
# from django.contrib import admin
# from .models import (
#     CompteHebdomadaire, ValeurAjoutee, CompteCredit, CompteDebit,
#     Operation, Ticket, TicketRetire, Administrateur
# )
# from django.contrib.auth.admin import UserAdmin

# # 👇 Admin pour le modèle Administrateur personnalisé
# class AdministrateurAdmin(UserAdmin):
#     model = Administrateur
#     list_display = ('username', 'email', 'fonction', 'is_staff', 'is_superuser')
#     list_filter = ('fonction', 'is_staff', 'is_superuser')
#     fieldsets = (
#         (None, {'fields': ('username', 'email', 'password', 'photo', 'fonction')}),
#         ('Permissions', {'fields': ('is_staff', 'is_superuser', 'groups', 'user_permissions')}),
#         ('Important dates', {'fields': ('last_login', 'date_joined')}),
#     )
#     add_fieldsets = (
#         (None, {
#             'classes': ('wide',),
#             'fields': ('username', 'email', 'fonction', 'photo', 'password1', 'password2', 'is_staff', 'is_superuser')}
#         ),
#     )
#     search_fields = ('username', 'email')
#     ordering = ('username',)

# # 👇 Admin pour les autres modèles
# @admin.register(CompteHebdomadaire)
# class CompteHebdomadaireAdmin(admin.ModelAdmin):
#     list_display = ('numero', 'designation', 'valeur', 'total', 'date_debut', 'date_fin')
#     search_fields = ('numero', 'designation')

# @admin.register(ValeurAjoutee)
# class ValeurAjouteeAdmin(admin.ModelAdmin):
#     list_display = ('numero', 'designation', 'valeur', 'date')
#     search_fields = ('numero', 'designation')

# @admin.register(CompteCredit)
# class CompteCreditAdmin(admin.ModelAdmin):
#     list_display = ('nom', 'solde', 'date')
#     search_fields = ('nom',)

# @admin.register(CompteDebit)
# class CompteDebitAdmin(admin.ModelAdmin):
#     list_display = ('nom', 'solde', 'date')
#     search_fields = ('nom',)

# @admin.register(Operation)
# class OperationAdmin(admin.ModelAdmin):
#     list_display = ('libelle', 'montant', 'date', 'Observation')
#     search_fields = ('libelle',)

# @admin.register(Ticket)
# class TicketAdmin(admin.ModelAdmin):
#     list_display = ('client', 'montant_journalier', 'jours_verse', 'nombre_jours_total', 'encours', 'retrait_effectue', 'date_debut')
#     search_fields = ('client',)
#     list_filter = ('encours', 'retrait_effectue')

# @admin.register(TicketRetire)
# class TicketRetireAdmin(admin.ModelAdmin):
#     list_display = ('client', 'montant_journalier', 'jours_verse', 'total_retiré', 'date_debut', 'date_retrait')
#     search_fields = ('client',)

# # 👇 Enregistrer le modèle Administrateur personnalisé
# admin.site.register(Administrateur, AdministrateurAdmin)
