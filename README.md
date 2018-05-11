# forum-app 
Personal Project for Upgrading and Showcasing My Skills. I plan to continiously work on this project by constantly adding new functionalities. I primarily focus on back-end side so dont mind the styles though I could maybe beautify it later on. 
### Note
Same functionality could be done differently from time to time, that's simply because i like experimenting with my code.
## Prerequisites
For current version you will need:
- local server
- database setup
### Database structure
```
__users__: id, email, username, password, created_at, updated_at

__roles__: id, name, created_at, updated_at

__permissions__: id, name, created_at, updated_at

__role_perm__: role_id, perm_id

__user_role__: user_id, role_id
```
