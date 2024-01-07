// websocket_server.mjs
import WebSocket from 'ws';
import http from 'http';
import express from 'express';

const app = express();
const server = http.createServer(app);
const wss = new WebSocket.Server({ noServer: true });

let latestData = {
  registrar: '',
  cashier: '',
  finance: '',
};



function broadcastData() {
  wss.clients.forEach((client) => {
    if (client.readyState === WebSocket.OPEN) {
      client.send(JSON.stringify(latestData));
    }
  });
}



function updateLatestData(data) {

  latestData.registrar = data.registrar;
  latestData.cashier = data.cashier;
  latestData.finance = data.finance;
}

wss.on('connection', (ws) => {
  console.log('WebSocket connection established');


  ws.send(JSON.stringify(latestData));
  

  ws.on('message', (message) => {
    console.log(`Received message: ${message}`);
  
    try {

      const data = JSON.parse(message);
  

    updateLatestData(data);
  
    broadcastData();

    } catch (error) {
      console.error('Error parsing incoming message:', error);
    }
  });
  
});

server.on('upgrade', (request, socket, head) => {
  wss.handleUpgrade(request, socket, head, (ws) => {
    wss.emit('connection', ws, request);
  });
});

server.listen(3000, () => {
  console.log('WebSocket server is running on port 3000');
});

