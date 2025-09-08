from django.urls import path
from finance import views

urlpatterns = [
    path('', views.login_view, name="page_connexion"),
    path('page/accueil', views.page_accueil, name="page_acceil"),
    path('deconnexion/', views.logout_view, name="deconnexion"),
    # VALEURS AJOUTÉES
    path('valeur-ajouter/', views.page_valeur_ajouter, name='valeur-ajouter'),
    path('eregistrement/', views.ajout_valeur, name='eregistrement'),
    path('modifier-valeur/<int:pk>/', views.modifier_valeur, name='modifie_valeur'),
    path('supprime-valeur/<int:pk>/', views.supprimer_valeur, name='supprimer_valeur'),
    # CHARGES
    path('charges/', views.charge_effectue, name='charge'),
    path('charges/ajouter/', views.ajout_charge, name='ajout_charge'),
    path('charges/modifier/<int:pk>/', views.modifier_charge, name='modifier_charge'),
    path('charges/supprimer/<int:pk>/', views.supprimer_charge, name='supprimer_charge'),
    # COMPTE CREDIT
    path('compte-credit/', views.compte_credit, name='credit'),
    path('ajout-compte-credit/', views.ajout_compte_credit, name='ajout_compte_credit'),
    path('modifier-compte-credit/<int:pk>/', views.modifier_compte_credit, name='modifier_compte_credit'),
    path('supprimer-compte-credit/<int:pk>/', views.supprimer_compte_credit, name='supprimer_compte_credit'),
    # COMPTE DEBIT
    path('compte-debit/', views.compte_debit, name='debit'),
    path('compte-debit/ajout/', views.ajout_compte_debit, name='ajout_compte_debit'),
    path('compte-debit/modifier/<int:pk>/', views.modifier_compte_debit, name='modifier_compte_debit'),
    path('compte-debit/supprimer/<int:pk>/', views.supprimer_compte_debit, name='supprimer_compte_debit'),
    #TICKET TONTINE
    path('tickets/', views.liste_tickets, name='liste_tickets'),
    path('tickets/ajout/', views.ajout_ticket, name='ajout_ticket'),
    path('tickets/modifier/<int:pk>/', views.modifier_ticket, name='modifier_ticket'),
    path('tickets/supprimer/<int:pk>/', views.supprimer_ticket, name='supprimer_ticket'),
    path('tickets/ajouter-jour/<int:pk>/', views.ajouter_jour_ticket, name='ajouter_jour_ticket'),
    path('tickets/retrait/<int:pk>/', views.retirer_ticket, name='retirer_ticket'),
    #path('recherche-client/', views.recherche_client, name='recherche_client'),
    # path('detail-client/<int:pk>/', views.detail_client, name='detail_client'),
    path('imprimer-tickets/', views.impression_tickets, name='imprimer_tickets'),
    path('tickets/retire/', views.liste_tickets_retire, name='liste_tickets_retire'),
    path('compte-hebdo/creer/', views.creer_compte_hebdo, name='creer_compte_hebdo'),
    path('compte-hebdo/', views.liste_compte_hebdo, name='liste_compte_hebdo'),
    # boutique/urls.py
    path('register/', views.register_view, name='register'),


]
