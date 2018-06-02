

let create_link = document.querySelector("#create-thread");

create_link.onclick = function() {
    let subject = document.getElementById('subject').value;
    let message = document.getElementById('message').value;
    let topic_id = document.getElementById('topic_id').value;

    let data = {
        subject: subject,
        message: message,
        topic_id: topic_id
    } 

    create_thread(data);
}

function create_thread(data)
{
    let request = new XMLHttpRequest();
    request.open("POST", "admin/includes/api/thread/create.php");
    request.send(JSON.stringify(data));

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            //console.log(JSON.parse(request.responseText).message);
            window.location.href = "http://localhost/forum-app/topic.php?topic_id=" + data.topic_id;
        }
    }
}