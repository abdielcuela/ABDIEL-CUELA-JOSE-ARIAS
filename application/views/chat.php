<div id="chat-box"></div>
<input type="text" id="mensaje" placeholder="Escribe un mensaje...">
<button onclick="enviarMensaje()">Enviar</button>

<script>
    var socket = io('http://localhost:3000'); // Conectar con el servidor WebSocket

    // Escuchar los mensajes del servidor
    socket.on('mensaje', function(data) {
        var chatBox = document.getElementById('chat-box');
        chatBox.innerHTML += '<p>' + data + '</p>';
    });

    // Función para enviar un mensaje
    function enviarMensaje() {
        var mensaje = document.getElementById('mensaje').value;
        socket.emit('mensaje', mensaje); // Enviar el mensaje al servidor WebSocket
        document.getElementById('mensaje').value = ''; // Limpiar el input
    }
</script>
