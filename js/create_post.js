document.querySelector("input[name='reply']").onclick = function() {
    let thread_id = document.querySelector("input[name='thread_id']").value;
    let reply_message = document.getElementById('reply').value;
    console.log(reply_message);
    let data = {
        thread_id: thread_id,
        reply_message: reply_message
    }

    create_post(data);
}

function create_post(data)
{
    let request = new XMLHttpRequest();
    request.open('POST', 'admin/includes/api/post/create.php');
    request.send(JSON.stringify(data));
    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            //console.log(JSON.parse(request.responseText).message);
            location.reload(true);
        }
    }
}