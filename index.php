<?php require 'script.php'; ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./css/bootstrap.min.css">

  <!-- Open Iconic icons for Bootstrap-->
  <link rel="stylesheet" href="./css/open-iconic-bootstrap.min.css">


  <!-- Custom CSS -->
  <link rel="stylesheet" href="./css/styles.css">

  <title>koalaSports Wichteln</title>
  <link rel="icon" type="image/png" href="res/favicon.png">
</head>

<?php if ($page == "index") : ?>

<body>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="d-none d-sm-block display-3">koalaSports Wichteln</h1>
      <h1 class="d-block d-sm-none display-4">koalaSports Wichteln</h1>
      <hr>
      <p class="lead">Es ist mal wieder so weit! Du weißt wie's funktioniert? Mach' dich gleich rein:</p>
      <a class="btn btn-primary btn-lg" href="?page=secure" role="button">Mitmachen</a>
    </div>
  </div>
  <div class="container">

    <h1 class="mt-5"><small class="text-secondary"><span class="oi oi-info" aria-hidden="true"></span></small>&ensp;Um was
      geht's?
    </h1>
    <p class="lead">2015 zuerst eingeführt, ist das koalaSports Wichteln absolute Tradition.</p>
    <p>
      Wie beim Wichteln üblich, bekommt jeder einen Partner zugeteilt, dem er dann ein tolles Geschenk legen <s>muss</s>
      darf. Normalerweise sind das CS:GO Items. Der Kreativität darf aber freien Lauf gelassen werden. <small><a href="#gifts">Mehr
          Details zu den Geschenken</a></small>
    </p>
    <p>
      Jeder Mitspieler weiß dabei nur, wem er ein persönliches Geschenk vorbereiten wird. Von wem man beschenkt wird, bleibt geheim.
    </p>

    <h1 class="mt-5"><small class="text-success"><span class="oi oi-task" aria-hidden="true"></span></small>&ensp;Wie nehme
      ich teil?
    </h1>
    <p>Um auch ein personalisiertes Wichtelgeschenk zu erhalten, sowie selbst legen zu dürfen, klicke einfach auf <a href="?page=secure">mitmachen</a>.</p>
    <h4 class="mb-3">Ablauf</h4>
    <div class="row">
      <div class="col-lg-4 mb-2">

        <?php if ($gamestate <= 0) : ?>
        <!-- Active -->
        <div class="card">
          <div class="card-header bg-primary text-white">
            <b>1.</b> Anmelden<span class="float-right oi oi-pencil" aria-hidden="true"></span>
          </div>
          <div class="card-body">
            <h5 class="text-center"><small class="text-secondary">bis</small> <b>
                <?= display_date($dates, "register"); ?></b></h5>
          </div>
        </div>

        <?php else : ?>
        <!-- Disabled -->
        <div class="card bg-light text-secondary">
          <div class="card-header">
            <b>1.</b> Anmelden<span class="float-right oi oi-pencil" aria-hidden="true"></span>
          </div>
          <div class="card-body">
            <h5 class="text-center"><small class="text-secondary">bis</small> <b>
                <?= display_date($dates, "register"); ?></b></h5>
          </div>
        </div>
        <?php endif; ?>

      </div>
      <div class="col-lg-4 mb-2">

        <?php if ($gamestate <= 1) : ?>
        <!-- Active -->
        <div class="card">
          <div class="card-header bg-warning text-dark">
            <b>2.</b> Geschenk vorbereiten<span class="float-right oi oi-box" aria-hidden="true"></span>
          </div>
          <div class="card-body">
            <h5 class="text-center"><small class="text-secondary">bis</small> <b>
                <?= display_date($dates, "gifts"); ?></b></h5>
          </div>
        </div>

        <?php else : ?>
        <!-- Disabled -->
        <div class="card bg-light text-secondary">
          <div class="card-header">
            <b>2.</b> Geschenk vorbereiten<span class="float-right oi oi-box" aria-hidden="true"></span>
          </div>
          <div class="card-body">
            <h5 class="text-center"><small class="text-secondary">bis</small> <b>
                <?= display_date($dates, "gifts"); ?></b></h5>
          </div>
        </div>
        <?php endif; ?>

      </div>
      <div class="col-lg-4 mb-2">

        <?php if ($gamestate <= 2) : ?>
        <!-- Active -->
        <div class="card">
          <div class="card-header bg-danger text-white">
            <b>3.</b> Geschenke verteilen<span class="float-right oi oi-heart" aria-hidden="true"></span>
          </div>
          <div class="card-body">
            <h5 class="text-center"><small class="text-secondary">am</small> <b>
                <?= display_date($dates, "end"); ?></b></h5>
          </div>
        </div>

        <?php else : ?>
        <!-- Disabled -->
        <div class="card bg-light text-secondary">
          <div class="card-header">
            <b>3.</b> Geschenke verteilen<span class="float-right oi oi-heart" aria-hidden="true"></span>
          </div>
          <div class="card-body">
            <h5 class="text-center"><small class="text-secondary">am</small> <b>
                <?= display_date($dates, "end"); ?></b></h5>
          </div>
        </div>
        <?php endif; ?>

      </div>
    </div>

    <h1 class="mt-5" id="gifts"><small class="text-danger"><span class="oi oi-heart" aria-hidden="true"></span></small>&ensp;Die
      Geschenke
    </h1>
    <p>Da das koalaSports Meet-Up noch immer auf sich warten lässt, schenken wir ausschließlich virtuelle Gegenstände. In
      der Regel sind dies CS:GO Items, es können jedoch auch andere Gegenstände verschenkt werden. Im Folgenden ein paar
      Guidelines für euer Geschenk:</em></p>
    <h4 class="mb-3">Details</h4>
    <div class="row">
      <div class="col-lg-4 order-lg-1 mb-2">
        <div class="card h-100 bg-dark text-white">
          <div class="card-header">
            Geschenkwert<span class="float-right oi oi-euro" aria-hidden="true"></span>
          </div>
          <div class="card-body">
            <h2 class="text-center mt-3"><b>5,00&thinsp;€ - 10,00&thinsp;€</b></h2>
            <h6 class="text-center mt-3"><span class="text-secondary">Mindestwert: </span>3,00&thinsp;€</h6>
          </div>
        </div>
      </div>
      <div class="col-lg-4 order-lg-0 mb-2">
        <div class="card h-100 bg-dark text-white">
          <div class="card-header">
            Persönlicher Touch<span class="float-right oi oi-person" aria-hidden="true"></span>
          </div>
          <div class="card-body">
            <p class="text-center text-light">"Hauptsache FN xd?!"<br>Bitte nicht. Lieber ein paar Kratzer auf dem Skin und dafür
              ein persönliches Name-Tag, als den erstbesten 5,-€ Skin zu kaufen.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 order-lg-2 mb-2">
        <div class="card h-100 bg-dark text-white">
          <div class="card-header">
            Passendes Geschenk<span class="float-right oi oi-puzzle-piece" aria-hidden="true"></span>
          </div>
          <div class="card-body">
            <p class="text-center text-light">Versuche, darüber nachzudenken, worüber sich vor allem dein Wichtelpartner
              freuen würde. Ob die Verwirklichung eines Memes oder Erfüllung eines long-time Skin Wunschs!</p>
          </div>
        </div>
      </div>
    </div>
    <div style="margin-bottom: 4rem"></div>

  </div>
</body>

<?php elseif ($page == "secure") : ?>

<?php if ($secure_level == 1) : ?>

<body>
  <div class="container">
    <div class="mt-4"></div>
    <div class="row">
      <div class="col-sm">
        <h1>koalaSports Wichteln</h1>
      </div>
    </div>
    <hr>
    <p class="lead">Anmeldung via Steam</p>
    <div class="alert alert-danger mb-4" role="alert">
      <span class="oi oi-circle-x" aria-hidden="true"></span>&ensp;Teilnahme verweigert! Du bist kein <b>koalaSports</b> Mitglied.
    </div>
    <div class="card border-info mb-4">
      <div class="card-header">
        <span class="badge badge-pill badge-info" style="font-size: 1rem"><span class="oi oi-info" aria-hidden="true"></span></span>&ensp;Warum
        kann ich nicht teilnehmen?
      </div>
      <div class="card-body">
        <p class="card-text">Um zu verhindern, dass unautorisierte Personen beitreten können, musst jeder Teilnehmer Mitglied
          in der <b>koalaSportsCSGO</b>
          Steam-Gruppe sein. Falls du koalaSports-Mitglied bist, oder anderweitig eingeladen wurdest, am Wichteln teilzunehmen, wende
          dich bitte an Muhlex.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-2 col-md-6">
        <a class="btn btn-block btn-outline-dark" href="?page=index" role="button">zurück</a>
      </div>
    </div>
  </div>
  <div style="margin-bottom: 4rem"></div>
</body>

<?php elseif ($secure_level == 2) : ?>

<body>
  <div class="container">
    <div class="mt-4"></div>
    <div class="row">
      <div class="col-sm">
        <h1>koalaSports Wichteln</h1>
      </div>
      <div class="col-sm-auto text-right">
        <form action='' method='get'>
          <button class="btn btn-sm btn-outline-danger" type="submit" name="logout">Abmelden&ensp;<span class="oi oi-account-logout"></span></button>
        </form>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-xl-8 col-md-7 mb-4">

        <?php if ($gamestate <= 0) : ?> <!-- Registration is still open -->

        <form action='' method='post'>
          <?php if (!$is_active) : ?>
          <button class="btn btn-block btn-lg btn-primary" type="submit" name="participate">Teilnehmen&ensp;<span class="oi oi-account-login"></span></button>
          <?php else : ?>
          <button class="btn btn-block btn-sm btn-secondary" type="submit" name="participate">Ich möchte doch nicht mitmachen&ensp;<span class="oi oi-account-logout"></span></button>
          <?php endif; ?>
        </form>
        <h3 class="mt-4 mb-3"><span class="badge badge-pill badge-primary">Schritt 1</span> Anmelden</h3>
        <h5>Teilnehmen</h5>
        <p>
          Hier kannst du deine Teilnahme mit einem Klick auf den Button oben bestätigen.
          Solltest du dich dazu entscheiden, doch nicht teilzunehmen, kannst du deine Teilnahme hier auch wieder rückgängig machen.
          Bitte beachte jedoch, dass ab dem <b><?= display_date($dates, "register"); ?></b> keine Änderungen mehr möglich sind.
          Bis dahin solltest du dich also entscheiden, ob du mitspielen möchtest oder nicht.
        </p>
        <h5>Wichtelpartner</h5>
        <p>
          In der Teilnehmerliste siehst du alle Mitspieler, die sich bisher angemeldet haben.
          Sobald alle Teilnehmer angemeldet sind, wird dir per Zufall ein Wichtelpartner zugeteilt.
          Wer das ist, erfährst du auf dieser Seite nach dem <b><?= display_date($dates, "register"); ?></b>, sodass du rechtzeitig ein passendes Geschenk besorgen kannst.
        </p>

        <?php elseif ($gamestate == 1) : ?> <!-- Preparing gifts -->

        <div class="card text-center border-dark">
          <div class="card-header bg-dark text-white lead">
            Dein Wichtelpartner
          </div>
          <ul class="list-group list-group-flush">
            <a target="_blank" rel="noopener noreferrer" href="http://steamcommunity.com/profiles/<?= $match[0] ?>" class="list-group-item list-group-item-action bg-light partner p-2">
              <?= $match[1]; ?>
            </a>
          </ul>
        </div>
        <h3 class="mt-4 mb-3"><span class="badge badge-pill badge-warning text-dark">Schritt 2</span> Geschenke vorbereiten</h3>
        <h5>Ein Geschenk finden</h5>
        <p>
          Es ist soweit! Die Anmeldung wurde geschlossen und jeder weiß nun, wen er beschenken darf.
          Deinen eigenen Wichtelpartner kannst du oben einsehen.
        </p>
        <p>
          Nun gilt es, bis zum <b><?= display_date($dates, "gifts"); ?></b> ein für deinen Partner geeignetes Geschenk zu finden.
          Lass' deiner Kreativität freien Lauf, versuche jedoch bitte, dich dabei an die Guidelines zu halten.
        </p>
        <p>
          Steam hält Inventar-Gegenstände bis 7 Tage nach Erhalt im Inventar, sodass sie nicht gehandelt werden können.
          <b><em>Halte dich daher bitte auf jeden Fall an die gesetzte Deadline zur Abgabe.</em></b>
          Andernfalls kann dein Wichtelpartner das Geschenk nicht am Ausgabetag erhalten.
        </p>
        <h5 class="mb-3">Guidelines</h5>
        <div class="row">
          <div class="col-xl-4 order-xl-1 mb-2">
            <div class="card h-100 bg-dark text-white text-center">
              <div class="card-header">
                  <span class="oi oi-euro" aria-hidden="true"></span>
              </div>
              <div class="card-body p-2 aligh">
                <span style="font-size: 1.4rem"><b>5,00&thinsp;€ - 10,00&thinsp;€</b></span>
                <br>
                <small><span class="text-secondary">Mindestwert: </span>3,00&thinsp;€</small>
              </div>
            </div>
          </div>
          <div class="col-xl-4 order-xl-0 mb-2">
            <div class="card h-100 bg-dark text-white text-center">
              <div class="card-header">
                  <span class="oi oi-person" aria-hidden="true"></span>
              </div>
              <div class="card-body p-2">
                <span class="text-light">Gestalte dein Geschenk so persönlich wie möglich.</span>
              </div>
            </div>
          </div>
          <div class="col-xl-4 order-xl-2 mb-2">
            <div class="card h-100 bg-dark text-white text-center">
              <div class="card-header">
                <span class="oi oi-puzzle-piece" aria-hidden="true"></span>
              </div>
              <div class="card-body p-2">
                <span class="text-light">Überlege, worüber sich dein Wichtelpartner freuen würde!</span>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <h5>Das Geschenk abgeben</h5>
        <p>
          Sobald du das perfekte Geschenk für deinen Wichtelpartner hast, sende dieses bitte an <b>Muhlex</b>.
          Für Steam Inventar-Items, wie z. B. bei CS:GO Skins, sende bitte ein entsprechendes Steam Trade Offer.
        </p>
        <a class="btn btn-primary" href="https://steamcommunity.com/tradeoffer/new/?partner=68590994&token=crKt5tPM">Trade Offer senden</a>

        <?php elseif ($gamestate <= 2) : ?> <!-- Gifts will be given out -->

        <div class="card text-center border-dark">
          <div class="card-header bg-dark text-white lead">
            Dein Wichtelpartner
          </div>
          <ul class="list-group list-group-flush">
            <a target="_blank" rel="noopener noreferrer" href="http://steamcommunity.com/profiles/<?= $match[0] ?>" class="list-group-item list-group-item-action bg-light partner p-2">
              <?= $match[1]; ?>
            </a>
          </ul>
        </div>
        <h3 class="mt-4 mb-3"><span class="badge badge-pill badge-danger">Schritt 3</span> Geschenke verteilen</h3>
        <h5>Fast geschafft!</h5>
        <p>
          Jetzt, da alle Geschenke abgegeben sind, heißt es nur noch etwas warten.
          Steam schließt alle Inventar-Gegenstände eine Woche lang vom Handel aus, nachdem sie den Besitzer gewechselt haben.
          Daher können die Geschenke erst mit einer Verzögerung verteilt werden.
        </p>
        <h5>Ausgabetag</h5>
        <p>
          Finde dich am <b><?= display_date($dates, "end"); ?></b> im koalaSports Discord ein, um bei der Geschenkvergabe dabei zu sein!
          Sobald abzusehen ist, dass die meisten Teilnehmer online sind, beginnen wir mit dem Verteilen der Geschenke.
          Solltest du an diesem Tag verhindert sein, erhältst du trotzdem ein Trade-Offer für dein Geschenk, welches du jederzeit annehmen kannst.
        </p>

        <?php elseif ($gamestate <= 3) : ?> <!-- Gifts have been given out, game ended -->

        <h3 class="mt-4 mb-3">Vielen Dank für deine Teilnahme!</h3>
        <h5>Bis zum nächsten Mal.</h5>
        <p>
          Die Geschenke sind verteilt und du hast hoffentlich etwas genauso tolles bekommen, wie du selbst verschenkt hast.
        </p>
        <p>
          In der Hoffnung, dass das koalaSports Wichteln nicht aus seiner kürzlich geschaffenen Tradition fällt:
          Bis ins nächste Jahr!
        </p>
        <?php endif; ?>



        <hr class="mt-4">
        <h5 class="mb-3">Ablauf</h5>
        <div class="row">
          <div class="col-sm-4 mb-2">

            <?php if ($gamestate <= 0) : ?>
            <!-- Active -->
            <div class="card text-center">
              <div class="card-header bg-primary text-white">
                <span class="oi oi-pencil" aria-hidden="true"></span>
              </div>
              <div class="card-body p-1">
                <span class="text-center"><small class="text-secondary">bis</small> <b>
                    <?= display_date($dates, "register"); ?></b></span>
              </div>
            </div>

            <?php else : ?>
            <!-- Disabled -->
            <div class="card bg-light text-secondary text-center">
              <div class="card-header">
                <span class="oi oi-pencil" aria-hidden="true"></span>
              </div>
              <div class="card-body p-1">
                <span class="text-center"><small class="text-secondary">bis</small> <b>
                    <?= display_date($dates, "register"); ?></b></span>
              </div>
            </div>
            <?php endif; ?>

          </div>
          <div class="col-sm-4 mb-2">

            <?php if ($gamestate <= 1) : ?>
            <!-- Active -->
            <div class="card text-center">
              <div class="card-header bg-warning text-dark">
                <span class="oi oi-box" aria-hidden="true"></span>
              </div>
              <div class="card-body p-1">
                <span class="text-center"><small class="text-secondary">bis</small> <b>
                    <?= display_date($dates, "gifts"); ?></b></span>
              </div>
            </div>

            <?php else : ?>
            <!-- Disabled -->
            <div class="card bg-light text-secondary text-center">
              <div class="card-header">
                <span class="oi oi-box" aria-hidden="true"></span>
              </div>
              <div class="card-body p-1">
                <span class="text-center"><small class="text-secondary">bis</small> <b>
                    <?= display_date($dates, "gifts"); ?></b></span>
              </div>
            </div>
            <?php endif; ?>

          </div>
          <div class="col-sm-4 mb-2">

            <?php if ($gamestate <= 2) : ?>
            <!-- Active -->
            <div class="card text-center">
              <div class="card-header bg-danger text-white">
                <span class="oi oi-heart" aria-hidden="true"></span>
              </div>
              <div class="card-body p-1">
                <span class="text-center"><small class="text-secondary">am</small> <b>
                    <?= display_date($dates, "end"); ?></b></span>
              </div>
            </div>

            <?php else : ?>
            <!-- Disabled -->
            <div class="card bg-light text-secondary text-center">
              <div class="card-header">
                <span class="oi oi-heart" aria-hidden="true"></span>
              </div>
              <div class="card-body p-1">
                <span class="text-center"><small class="text-secondary">am</small> <b>
                    <?= display_date($dates, "end"); ?></b></span>
              </div>
            </div>
            <?php endif; ?>

          </div>
        </div>

      </div>

      <div class="col-xl-4 col-md-5 mb-4">
        <div class="card">
          <div class="card-header lead text-center">
            Teilnehmer
            <?php if ($participants != false) : ?>
            <span class="badge badge-secondary"><?= count($participants); ?></span>
            <?php endif; ?>
          </div>

          <ul class="list-group list-group-flush">

            <?php if ($participants != false) : ?>
            <?php foreach ($participants as $row) : ?>
            <a target="_blank" rel="noopener noreferrer" href="http://steamcommunity.com/profiles/<?= $row["steamID64"] ?>" class="list-group-item list-group-item-action participants-list-group-item">
              <div class="row no-gutters">
                <div class="col-auto">
                  <img src="<?= $row["avatar"] ?>" class="rounded">
                </div>
                <div class="col text-truncate ml-2">
                  <span class="align-middle"><?= $row["name"] ?></span>
                </div>
                <div class="col-auto">
                  <img src="./res/steam_black.svg" class="steam">
                </div>
              </div>
            </a>
            <?php endforeach; ?>
            <?php else : ?>
            <li class="list-group-item text-center align-middle text-secondary small">
              Es gibt noch keine Teilnehmer.<br>
              Deine Chance, der Erste zu sein!
            </li>
            <?php endif; ?>

          </ul>

        </div>

        <?php if (!check_steam_update_timeout()) :?>
        <div class="mt-2 small text-secondary text-right">
          Name oder Avatar sind nicht aktuell?
          <a href="?page=secure&update_steamdata" class="mt-3">Jetzt aktualisieren.</a>
        <div class="mt-2">
        <?php endif; ?>
      </div>
    </div>

  </div>
  <div style="margin-bottom: 4rem"></div>
</body>

<?php else : ?>

<body>
  <div class="container">
    <div class="mt-4"></div>
    <div class="row">
      <div class="col-sm">
        <h1>koalaSports Wichteln</h1>
      </div>
    </div>
    <hr>
    <p class="lead">Anmeldung via Steam</p>
    <p>Du kannst dich von nun an direkt über Steam anmelden und benötigst keinen zusätzlichen Account.</p>
    <p>Bitte beachte, dass du nur beitreten kannst, wenn du Mitglied der <b>koalaSportsCSGO</b> Steam-Gruppe bist.</p>
    <?php loginbutton(); ?>
  </div>
</body>
<?php endif; ?>
<?php endif; ?>
