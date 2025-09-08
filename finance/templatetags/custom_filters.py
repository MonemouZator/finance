from django import template

register = template.Library()

@register.filter
def times(number):
    """Retourne un range de 1 à number inclus"""
    return range(1, number + 1)
