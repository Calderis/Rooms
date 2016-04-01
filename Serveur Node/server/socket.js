'use strict';

var stats = require('./stats');

module.exports = function (server) {
  var io = require('socket.io').listen(server),
    _ = require('lodash'),
    progress = require('./progressbar'),
    store = require('./store');

  /*io.set('log level', 2);*/

    
 io.sockets.on('connection', function (socket) {
      console.log("connection detectée");
      var local = {
        name : "",
        room : 0
      }
      socket.on("newUser", function(data){
          console.log("newUser");
          local.name = data.name;
          local.room = data.room;
          socket.join(data.room);
          io.to(data.room).emit("newFriend", data);
      });
      
      
      socket.on('disconnect', function() {
          console.log("disconnected");
        io.to(local.room).emit("quitFriend", local.name);
        socket.leave(local.room);
    });
      
      
      
      
      socket.on("newMsg",function(data){
          console.log("newMsg");
          io.to(local.room).emit("incomingMsg", {name:local.name, msg:data.msg, img:data.img});
      });
      
      /***** Download *****/
    socket.on('pause', function (infoHash) {
      console.log('pausing ' + infoHash);
      var torrent = store.get(infoHash);
      if (torrent && torrent.swarm) {
        torrent.swarm.pause();
      }
    });
    socket.on('resume', function (infoHash) {
      console.log('resuming ' + infoHash);
      var torrent = store.get(infoHash);
      if (torrent && torrent.swarm) {
        torrent.swarm.resume();
      }
    });
    socket.on('select', function (infoHash, file) {
      console.log('selected ' + infoHash + '/' + file);
      var torrent = store.get(infoHash);
      if (torrent && torrent.files) {
        file = torrent.files[file];
        file.select();
      }
    });
    socket.on('deselect', function (infoHash, file) {
      console.log('deselected ' + infoHash + '/' + file);
      var torrent = store.get(infoHash);
      if (torrent && torrent.files) {
        file = torrent.files[file];
        file.deselect();
      }
    });
  });

  store.on('torrent', function (infoHash, torrent) {
    function listen() {
      var notifyProgress = _.throttle(function () {
        if (torrent) {
          io.sockets.emit('download', infoHash, progress(torrent.bitfield.buffer));
        }
      }, 1000);

      io.sockets.emit('verifying', infoHash, stats(torrent));

      torrent.once('ready', function () {
        io.sockets.emit('ready', infoHash, stats(torrent));
      });

      torrent.on('uninterested', function () {
        io.sockets.emit('uninterested', infoHash);
      });

      torrent.on('interested', function () {
        io.sockets.emit('interested', infoHash);
      });

      var interval = setInterval(function () {
        io.sockets.emit('stats', infoHash, stats(torrent));
      }, 1000);

      torrent.on('verify', notifyProgress);

      torrent.once('destroyed', function () {
        clearInterval(interval);
        io.sockets.emit('destroyed', infoHash);
        torrent = null;
      });
    }

    if (torrent.torrent) {
      listen();
    } else {
      torrent.once('verifying', listen);
    }
  });
};
