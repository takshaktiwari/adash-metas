# Introduction

An extension to <a href="https://github.com/takshaktiwari/adash" target="_blank">takshaktiwari/adash</a> for adding meta tags and content to pages, targeting the url. You can also set tags for whole site (globally) at one place. This is helpful for SEO Managers.

# Implementation

Install the package with composer with given command and run the migrations php artisan migrate

    composer require takshak/adash-metas

Add component to admin sidebar, inside ul element for getting the links in admin sidebar

    <x-ametas-ametas:admin-sidebar-links />

Run the migrations

    php artisan migrate

# Components

## Admin sidebar menu

**<x-ametas-ametas:admin-sidebar-links />**: Use this component to show the menu item in admin sidebar

## Displaying meta tags on website

**<x-ametas-ametas:metatags />**: Add this component in the head tag of your website to display meta tags there
