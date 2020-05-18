@extends('layouts.main')

@section('title')
    Discussion Thread
@endsection

@section('header')
    Discussion Thread
@endsection

@section('content')
    <h3>Welcome to the {{$activity->name}} Discussion Thread</h3>
    <div style="margin-bottom:20px;">
        Total Active Users: <span id="total-users">0</span>
    </div>
    <form>
        @if (Auth::check())
        <textarea name="{{$activity->id}}" rows="5" class="col-md" id="message"></textarea>
        <br>
        <button id="post_button"
                name="{{$activity->id}}"
                value="{{Auth::user()->name}}"
                class="btn btn-primary"
                type="submit">Post</button>
        @else
        <p class="text-center">Sign up or login to join the discussion!</p>
        <textarea name="{{$activity->id}}" rows="5" class="col-md" id="message" hidden></textarea>
        <br>
        <button id="post_button"
                name="{{$activity->id}}"
                value=""
                class="btn btn-primary"
                type="submit" hidden>Post</button>
        @endif
    </form>
    <div id="createActivityButton" style="margin-top:20px; margin-bottom:20px;">
        <a href="/activities" class="btn btn-secondary text-center">Back</a>
    </div>

    <table id="comments_table" class="table table-striped" style="background-color:#202020; margin-bottom:40px;">
        <thead style="color:white;">
            <tr>
                <th>Comment</th>
                <th>Posted By</th>
                <th>Date Posted</th>
            </tr>
        </thead>
        <tbody style="color:white;">
        </tbody>
    </table>
    <script type="text/javascript">
        const pubsub = {
            _callbacksByEvent: {},

            publish(event, data) {
                this._callbacksByEvent[event].forEach((callback) => {
                    callback(data);
                });
            },
            subscribe(event, callback) {
                if (!this._callbacksByEvent[event]) {
                    this._callbacksByEvent[event] = [];
                }
                this._callbacksByEvent[event].push(callback);
            }
        };

        const connection = new WebSocket('wss://final-project-node-mjkinol.herokuapp.com');

        connection.onmessage = (event) => {
            let eventData = JSON.parse(event.data);
            if (eventData.type === 'total-users-changed') {
                let { type, data } = JSON.parse(event.data)
                pubsub.publish(type, data);
            } else{
                // if message
                pubsub.publish(eventData.type, eventData);
            }
        };

        pubsub.subscribe('total-users-changed', (count) => {
            document.getElementById('total-users').innerText = count;
        });

        connection.onopen = () => {  
            connection.send(JSON.stringify({
                type: 'total-users-changed'
            }));    
            // initialize the discussion data on open after updateing total users
            var d = new Date();
            let message = "";
            let name = "";
            let activity_id = document.querySelector('#post_button').name;
            let table_id = document.querySelector('#message').name;
            connection.send(JSON.stringify({
                type: 'new-post',
                comment: message,
                date: d.toLocaleDateString("en-US"),
                creator: name,
                activityId: activity_id,
                tableId: table_id 
            }));
        };

        pubsub.subscribe('new-post', (data) => {
            if (data.sqlResults.length == 0){
                var table = document.getElementById("comments_table");
                table.innerHTML = "";
                var row1 = table.insertRow(0);
                row1.style.color = "white";
                row1.style.fontWeight = "500";
                var c1 = row1.insertCell(0);
                c1.innerHTML = "No posts yet, be the first!";
            } else{
                var table = document.getElementById("comments_table");
                table.innerHTML = "";
                var row1 = table.insertRow(0);
                row1.style.color = "white";
                row1.style.fontWeight = "500";
                var c1 = row1.insertCell(0);
                var c2 = row1.insertCell(1);
                var c3 = row1.insertCell(2);
                c1.innerHTML = "Comment";
                c2.innerHTML = "Posted By";
                c3.innerHTML = "Date Posted";
                for(var i = 0; i < data.sqlResults.length; i++) {
                    var row2 = table.insertRow(1);
                    row2.style.color = "white";
                    var cell1 = row2.insertCell(0);
                    var cell2 = row2.insertCell(1);
                    var cell3 = row2.insertCell(2);
                    cell1.innerHTML = data.sqlResults[i].comment;
                    cell2.innerHTML = data.sqlResults[i].creator;
                    cell3.innerHTML = data.sqlResults[i].date;
                }
            }
        });

        document.querySelector('form').addEventListener('submit', (event) => {
            event.preventDefault();
            let message = document.querySelector('#message').value;
            let name = document.querySelector('#post_button').value;
            let activity_id = document.querySelector('#post_button').name;
            let table_id = document.querySelector('#message').name;
            var d = new Date();
            let data = JSON.stringify({
                type: 'new-post',
                comment: message,
                date: d.toLocaleDateString("en-US"),
                creator: name,
                activityId: activity_id,
                tableId: table_id 
            });
            connection.send(data);
            document.querySelector('#message').value = '';
        });
    </script>

@endsection