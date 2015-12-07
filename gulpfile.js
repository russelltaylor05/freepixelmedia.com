var gulp          = require('gulp');
var express       = require('express');
var serverport    = 5000;

var server = express();
server.use(express.static('./'));
server.all('/*', function(req, res) {
  res.sendFile('index.html', { root: './' });
});

gulp.task('start', [], function() {
  server.listen(serverport);
  console.log('Server started at localhost:' + serverport);
});