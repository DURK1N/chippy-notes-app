<!-- Views/noteView.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Note Display</title>
    <meta charset="UTF-8">
    <meta name="description" content="Simple note jotting app.">
    <meta name="author" content="Group 14">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body>
    <?php include "partials/sideBar.php"; ?>
    <div class="content-wrapper">
        
        <?php if (isset($displayText)): ?>
            <div class="note-wrapper">
                <header>
                    <input type="text" name="noteInputTitle" id="noteInputTitle">
                </header>
                <p>Entered Text: <?php echo htmlspecialchars($displayText); ?></p>
            </div>
        <?php endif; ?>

        <form action="index.php" method="POST" class="text-bar">
            <input type="text" name="noteInputText" id="noteInputText">
            <button type="submit">
                <span class="material-symbols-outlined">arrow_upward_alt</span>
            </button>
        </form>
        
        <script>
            document.getElementById("noteInputText").addEventListener("keypress", function (e) {
                if (e.key === "Enter") {
                    this.form.submit();
                }
            });

            function handleKeyPress(e) {
                var socket = io();

                var noteInputText = document.getElementById("noteInputText");
                var activeElement = document.activeElement;

                if (!activeElement || activeElement.tagName !== 'INPUT' || activeElement.type !== 'text') {
                    if (document.activeElement !== noteInputText) {
                        noteInputText.focus();
                        e.preventDefault();
                        // Line 50 -> 54 is from the sockets
                        if (noteInputText.value) {
                            socket.emit('note', noteInputText.value);
                            noteInputText.value = '';
                        }
                        if (e.key.length === 1) {
                            noteInputText.value += e.key;
                        }
                        // Line 58 -> 63 is from the sockets. This is what outputs the message to all connected clients
                        socket.on('note', function(msg) {
                            const item = document.createElement('p');
                            item.textContent = msg;
                            window.scrollTo(0, document.body.scrollHeight);
                        });
                    }
                }
            }

            document.addEventListener("keypress", handleKeyPress);
        </script>
    </div>
</body>
</html>
