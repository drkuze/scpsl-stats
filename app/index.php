<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Server Info</title>
  <style>
    /* Allgemeine Stile */
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #0d1117;
      color: #c9d1d9;
      line-height: 1.8;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    /* Header */
    h1 {
      color: #58a6ff;
      text-align: center;
      margin: 40px 0;
      font-size: 3rem;
    }

    /* Container für den Inhalt */
    #server-info {
      max-width: 900px;
      background-color: #161b22;
      padding: 30px;
      margin: auto;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.6);
      width: 100%;
    }

    /* Inhalte */
    p {
      font-size: 1.5rem;
      color: #8b949e;
      margin: 15px 0;
      line-height: 1.6;
    }

    b {
      color: #58a6ff;
    }

    /* Fehlerstil */
    .error {
      color: #ff7b72;
      font-weight: bold;
      font-size: 1.2rem;
    }

    /* Footer */
    footer {
      margin-top: auto;
      background-color: #161b22;
      color: #8b949e;
      padding: 20px 0;
      text-align: center;
      border-top: 1px solid #30363d;
      width: 100%;
    }

    footer a {
      color: #58a6ff;
      text-decoration: none;
      font-weight: bold;
    }

    footer a:hover {
      text-decoration: underline;
    }

    /* Mobile Anpassungen */
    @media (max-width: 768px) {
      h1 {
        font-size: 2rem;
        margin: 20px 0;
      }

      #server-info {
        padding: 20px;
        max-width: 95%;
      }

      p {
        font-size: 1.2rem;
        margin: 12px 0;
      }
    }

    @media (max-width: 480px) {
      h1 {
        font-size: 1.8rem;
        margin: 15px 0;
      }

      #server-info {
        padding: 15px;
        max-width: 90%;
      }

      p {
        font-size: 1rem;
        margin: 10px 0;
      }
    }
  </style>
</head>
<body>
  <h1>Server Information</h1>
  <div id="server-info">
    <p>Loading server data...</p>
  </div>

  <footer>
    <p>Made with ❤️ by <a href="https://github.com/" target="_blank">drkuze</a>. View on <a href="https://github.com/" target="_blank">GitHub</a>.</p>
  </footer>

  <script>
    // Fetch server info via PHP proxy
    fetch('serverinfo.php')
      .then(response => {
        if (!response.ok) {
          throw new Error(`Error: ${response.status} ${response.statusText}`);
        }
        return response.json();
      })
      .then(data => {
        const serverInfoHtml = `
          <p><b>Server Name:</b> ${data.serverName || 'N/A'}</p>
          <p><b>Online:</b> ${data.online ? 'Yes' : 'No'}</p>
          <p><b>Version:</b> ${data.version || 'N/A'}</p>
          <p><b>Players:</b> ${data.players || 0}</p>
          <p><b>Modded:</b> ${data.modded || 'No'}</p>
        `;
        document.getElementById('server-info').innerHTML = serverInfoHtml;
      })
      .catch(error => {
        console.error('Error fetching server info:', error);
        document.getElementById('server-info').innerHTML = `<p class="error">Fehler beim Abrufen der Daten. Bitte versuche es später erneut.</p>`;
      });
  </script>
</body>
</html>
