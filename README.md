# Better Notes - backend
This is a backend to a mobile app which you can find in this [repository](https://github.com/Mar-Los/Better_Notes-frontend). The goal of this app is to enable users to store their note files in specific folders of a folder system created by them. This structure is not stored on their phones, but in a database.

## Description of the app
This app behaves like "better" notes. Users need to authenticate in order to use the app. Each file belongs to a folder of a folder tree. This tree is created by users themselves. This whole structure is stored in a database, so users can access their folders and files even with a different device.

## Features
- Tree-like folder system stored in reletional database
- Database system consisting of 6 tables
- Signing with JWT
- Use of laravel resources
- RESTful API architecture
- Two note formats supported
    - Text - plain text notes
    - Dictionaries - notes displayed in lines, every line has a key column and a value column (like a dictionary)

## Used technologies
- [Laravel 7](https://laravel.com/)
- [Kalnoy/nestedset](https://github.com/lazychaser/laravel-nestedset) - Laravel package for working with trees in relational databases
- [Tymon/jwt-auth](https://github.com/tymondesigns/jwt-auth) - JWT authentication for Laravel & Lumen
