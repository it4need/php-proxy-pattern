## \faicon{thumbs-up} Motivation
Ein sehr simples Beispiel, warum man den Zugriff zu einem Objekt kontrollieren möchte, ist ein virtueller Proxy zum
verzögerten Nachladen eines Bildes (Lazy Loading). Es ist nicht immer notwendig, dass wir das Bild bereits beim
Instanzzieren des Objekts in den Speicher laden. Nehmen wir an, dass das Bild auf einer Website im unteren Bereich
angezeigt werden soll (below the fold). Beim Laden der Website ist es nicht notwendig, bereits alle Bilder auf der 
Website zu laden - es reicht vollkommen aus, diese Bilder zu laden, welche im sichtbaren Bereich der Website sind.
Die folgende Abbildung zeigt das Lazy-Loading anhand einer kürzlich verwendeten horizontalen Scrollbar.

![Beispiel des Lazy-Loading anhang einer vertikalen Scrollbar](../assets/images/lazyloading.jpg)