from django.contrib import admin
from django.urls import path, include

from django.conf import settings
from django.conf.urls.static import static

urlpatterns = [
    path('admin/', admin.site.urls),

    # Inclure toutes les URLs de l'app finance
    path('', include('finance.urls')),
    

    # ------------------- Valeur Ajoutée -------------------
    path('valeur-ajouter/', include('finance.urls')),
    path('valeur-modifier/', include('finance.urls')),
    path('valeur-supprimer/', include('finance.urls')),

    # ------------------- Charges -------------------
    path('liste-des-charges/', include('finance.urls')),
    path('ajout-des-charges/', include('finance.urls')),
    path('modification-des-charges/', include('finance.urls')),
    path('suppression-des-charges/', include('finance.urls')),

    # ------------------- Crédits -------------------
    path('liste-des-credits/', include('finance.urls')),
    path('ajout-des-credits/', include('finance.urls')),
    path('modification-des-credits/', include('finance.urls')),
    path('suppression-des-credits/', include('finance.urls')),

    # ------------------- Débits -------------------
    path('liste-des-debits/', include('finance.urls')),
    path('ajout-des-debits/', include('finance.urls')),
    path('modification-des-debits/', include('finance.urls')),
    path('suppression-des-debits/', include('finance.urls')),

    # ------------------- Tickets -------------------
    path('liste-des-tickets/', include('finance.urls')),
    path('ajout-ticket/', include('finance.urls')),
    path('modification-ticket/', include('finance.urls')),
    path('suppression-ticket/', include('finance.urls')),
    path('rechercher-client/', include('finance.urls')),


]
if settings.DEBUG:
    urlpatterns += static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)
