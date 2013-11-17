$( document ).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

});

// conn = new ab.Session(
//     'ws://d2l.dev:1111', // The host (our Latchet WebSocket server) to connect to
//     function() { // Once the connection has been established
//         conn.subscribe('chat/room/lobby', function(topic, event) {
//             console.log('event: ');
//             console.log(event);
//         });
//     },
//     function() {
//         // When the connection is closed
//         console.log('WebSocket connection closed');
//     },
//     {
//         // Additional parameters, we're ignoring the WAMP sub-protocol for older browsers
//         'skipSubprotocolCheck': false
//     }
// );
 // Write your code in the same way as for native WebSocket:
  // var ws = new WebSocket("ws://d2l.dev:1111/");
  // console.log(ws);
  // ws.onopen = function() {
  //   ws.send("Hello");  // Sends a message.
  //   console.log("Connection established!");
  // };
  // ws.onmessage = function(e) {
  //   // Receives a message.
  //   alert(e.data);
  // };
  // ws.onclose = function() {
  //   alert("closed");
  // };
