# Better Notes - backend
This is a backend to a mobile app which you can find in this [repository](https://github.com/Mar-Los/Better_Notes-frontend). The goal of this app is to store notes in interesting formats in a database.

### Currently supported formats
- Text - plain text notes
- Dictionaries - notes displayed in lines, every line has a key column and a value column (like a dictionary)

Another key feature of this app is the possibility to store notes in a treelike folder system.

### Design of the database
Each user has their own folder tree. Notes are related to folders.

## Used technologies
- [Laravel 7](https://laravel.com/)
- [Kalnoy/nestedset](https://github.com/lazychaser/laravel-nestedset)
- [Tymon/jwt-auth](https://github.com/tymondesigns/jwt-auth)