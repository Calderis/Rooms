@IF EXIST "%~dp0\node.exe" (
  "%~dp0\node.exe"  "%~dp0\node_modules\peerflix-server\server\bin.js" %*
) ELSE (
  node  "%~dp0\node_modules\peerflix-server\server\bin.js" %*
)