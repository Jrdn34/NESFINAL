<div class="intro" style="display: flex; align-items: flex-start; justify-content: space-between; color: #333; margin-left: 5%; margin-right: 5%; margin-top: 5%; font-size: 24px;">
    <div style="flex: 1; margin-right: 10%;">
        <h2 class="history" style="text-transform: uppercase; font-weight: bold; margin-bottom: 20px;">Notre équipe</h2>
        <p class="history-text" style="text-align: justify;">L'association dispose d'une équipe d'environ <strong>une dizaine de membres</strong>, tous prêts à nous accompagner et à participer activement lors des sorties que nous organisons. Leur disponibilité et leur engagement nous permettent de bénéficier d'un soutien précieux pour assurer <strong>le bon déroulement</strong> de ces événements.
            <br><br>Parmis ces accompagnants, nous retrouvons des personnes comme Matthieu, Pierre, Marine, Philippe, Aurore, Emmanuel et Didier. Toutes ces personnes sont <strong>des bénévoles</strong> qui ont à coeur de partager leur passion pour la montagne et de permettre à nos enfants de vivre <strong>des moments inoubliables</strong>.
            <br><br>Si vous souhaitez rejoindre notre équipe et nous apporter votre aide, n'hésitez pas à <strong>nous contacter</strong>. Nous serons ravis de vous accueillir parmi nous !
        </p>
        <a href="Machine.php"><button type="button" class="btn btn-link ">➔ Consulter nos machines</button></a>
        <a href="Historique.php"><button type="button" class="btn btn-link">➔ Découvrir notre histoire</button></a>
    </div>
    <div style="position: relative;">
        <img src="./img/equipe3.jpg" alt="Photo de l'équipe" class="equipe-image" style="width: 400px; height: auto; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-right: 5%; margin-top: 7%; cursor: pointer;" onclick="enlargeImage(this)">
        <p style="text-align: center; font-size: 14px; margin-top: 10px; cursor: pointer;" onclick="enlargeImage(this.previousElementSibling)">Cliquez ici pour agrandir</p>
        <img src="./img/equipe4.jpg" alt="Photo de l'équipe" class="equipe-image" style="width: 400px; height: auto; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-right: 5%; margin-top: 10%; cursor: pointer;" onclick="enlargeImage(this)">
        <p style="text-align: center; font-size: 14px; margin-top: 10px; cursor: pointer;" onclick="enlargeImage(this.previousElementSibling)">Cliquez ici pour agrandir</p>
    </div>
    <script>
        function enlargeImage(img) {
            var modal = document.createElement('div');
            modal.style.position = 'fixed';
            modal.style.top = '0';
            modal.style.left = '0';
            modal.style.width = '100%';
            modal.style.height = '100%';
            modal.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
            modal.style.display = 'flex';
            modal.style.alignItems = 'center';
            modal.style.justifyContent = 'center';
            modal.style.zIndex = '1000';
            modal.onclick = function() {
                document.body.removeChild(modal);
            };

            var enlargedImg = document.createElement('img');
            enlargedImg.src = img.src;
            enlargedImg.style.maxWidth = '90%';
            enlargedImg.style.maxHeight = '90%';
            enlargedImg.style.borderRadius = '15px';
            enlargedImg.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';

            modal.appendChild(enlargedImg);
            document.body.appendChild(modal);
        }
    </script></div>
</div>

