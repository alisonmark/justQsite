from django.contrib import admin

# Register your models here.
from .models import Category, iPhone, Sony
admin.site.register(Category)
admin.site.register(iPhone)
admin.site.register(Sony)
