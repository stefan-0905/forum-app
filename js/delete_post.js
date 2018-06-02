let posts = document.getElementsByClassName('delete-post');
console.log(posts);

for(let i = 0; i < posts.length; i++)
{
    let post = posts[i];
    post.onclick = function() {
        let post_id = this.dataset['postId'];
    }
}

function hello() 
{
    console.log("Hello my old friend.");
}