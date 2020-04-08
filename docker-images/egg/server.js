var os = require('os')
var http = require('http');

var handleRequest = function(request, response) {
  console.log('Received request for URL: ' + request.url);
  response.writeHead(200);
  response.end(process.env.EGG+'\n');
};
var www = http.createServer(handleRequest);
www.listen(8080);
