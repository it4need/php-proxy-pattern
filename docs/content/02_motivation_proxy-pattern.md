## \faicon{thumbs-up} \hspace{.1cm} Motivation

### Langweilig - die Erste: Sicherer Browser dank Zugriffsproxy
Stell dir mal vor, dass du einen sicheren Browser entwickeln möchtest, welcher aus Kostengründen allerdings z. B. bereits
vorhandene Browserschnittstellen im Hintergrund verwenden soll. Damit die Nutzer deines Browsers vor Datendiebstahl 
geschützt sind, soll dein Browser nur sichere HTTPS-Verbindungen erlauben und alle unsicheren HTTP-Verbindungen 
blockieren. Da der Quelltext deiner Engine allerdings nicht verändert werden kann/darf (z. B. aus Lizenzgründen), 
kannst du die Zugriffsbeschränkung auf HTTPS nicht einfach so in das Ursprungsobjekt einfügen. Jetzt kommt dein 
_Zugriffsproxy_ ins Spiel: Er kontrolliert den Zugriff auf den relevanten Teil der Browserschnittstelle (hier das Subjekt)
und delegiert alle weiteren Methodenaufrufe direkt an das Subjekt weiter. Somit muss der Quelltext deiner geplanten 
Engine nicht verändert werden und alle sind glücklich!

### Motiviert - die Zweite: Lazy-Loading mit virtuellem Proxy
Ein weiteres sehr simples Beispiel, warum du den Zugriff zu einem Objekt kontrollieren möchtest, ist ein _virtueller Proxy_ zum
verzögerten Laden eines Bildes (Lazy Loading). Es ist nämlich nicht immer notwendig, dass ein Bild bereits beim
Instanzzieren eines Objekts in den Speicher geladen werden muss. 

Stell dir vor, dass du ganz viele Bilder auf deiner Werbe-Website deines sicheren Browsers hast. Da viele dieser Bilder 
im unteren unsichtbaren Bereich ("below the fold") sind, ist es beim Laden der Website nicht sinnvoll, noch nicht sichtbare Bilder
deiner Website zu laden - es reicht also, dass nur diese Bilder geladen werden, die aktuell tatsächlich im sichtbaren 
Bereich der Website sind. Die folgende Abbildung zeigt das Lazy-Loading anhand einer kürzlich benutzten
horizontalen Scrollbalken:

![Beispiel des Lazy-Loading anhang einer vertikalen Scrollbar](../assets/images/lazyloading.jpg)

Das Laden des realen Bildes (also das Subjekt) wird also in diesem Beispiel durch einen Stellvertreter vertreten (Proxy) 
und der Zugriff auf das tatsächliche Objekt wird soweit verzögert, bis er wirklich erst notwendig ist.

### Hochmotiviert - die Dritte: Reporting der Downloads dank Remote-Proxy
Da du natürlich am Ende des Tages wissen möchtest, ob dein sicherer Browser von den Nutzern tatsächlich heruntergeladen 
wird, hast du dir bei der Planung der Website bereits einige Download-Statistiken überlegt:

- Datum
- Uhrzeit (in Stunden)
- Endgerätetyp

Diese Statistiken werden über die Downloads über deine Website generiert. Da du den Browser aber noch zusätzlich
auf Download-Portalen anbietest, musst du diese Zahlen natürlich ebenfalls in deine Statistik miteinbeziehen. 
Alle Download-Portale bieten dir API-Schnittstellen an, welche ebenfalls die oben genannten Daten liefern.
Mithilfe des Proxy-Objekts kannst du nun in die ursprüngliche Zugriffkontrolle des Statistik-Objekts eingreifen und z. B.
die Eigenschaften des Objekts auf die von der jeweiligen API-Schnittstelle zur Verfügung gestellten Daten setzen.
Weitere Methoden vom Proxies werden dann einfach an das eigentliche Reportobjekt (unserem Subjekt) delegiert.

 