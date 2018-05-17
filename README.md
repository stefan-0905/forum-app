# forum-app 
Personal Project for Upgrading and Showcasing My Skills. I plan to continiously work on this project by constantly adding new functionalities. I primarily focus on back-end side so dont mind the styles though I could maybe beautify it later on. 
### Note
Same functionality could be done differently from time to time, that's simply because i like experimenting with my code.
## Devlog
Currently I'm working on updating my existing code and implementing some security measures for accounts and site.

Working on front-end moderators functionality.
## Prerequisites
For current version you will need:
- local server
- database setup
### Database structure
<pre>
<b>users</b>: id, email, username, password, created_at, updated_at

<b>roles</b>: id, name, created_at, updated_at

<b>permissions</b>: id, name, created_at, updated_at

<b>role_perm</b>: role_id, perm_id

<b>user_role</b>: user_id, role_id

<b>board_list</b>: id, title, created_at, updated_at

<b>topics</b>: id, title, description, created_at, updated_at

<b>board_list_topics</b>: list_id, topic_id

<b>topics</b>: id, title, description, created_at, updated_at

<b>threads</b>: id, topic_id, user_id, subject, message, created_at, updated_at

<b>posts</b>: id, thread_id, user_id, message, created_at, updated_at
</pre>
