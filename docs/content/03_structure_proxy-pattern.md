##  \faicon{sitemap} \hspace{.1cm} Struktur & Sequenzdiagram
![Klassendiagram des Proxy-Musters](../assets/images/proxy_class_diagram.png){ .float-left width=60% }
![Sequenzdiagram des Proxy-Musters](../assets/images/proxy_sequence_diagram.png){ width=40% }

* **ISubjekt** definiert dabei das Interface für das Subjekt und den Proxy
* **Subjekt** ist die Klasse, welche die eigentliche Logik implementiert
* **Proxy** beinhaltet eine Eigenschaft, die eine Referenz zum Subjekt speichert. Methodenaufrufe werden in der Regel
anschließend an das Subjekt delegiert.
* **Client** ruft Methodenaufrufe über das definierte ISubject auf, sodass das 
[Liskovsche Substitutionsprinzip (LSP)](https://de.wikipedia.org/wiki/Liskovsches_Substitutionsprinzip) erfüllt bleibt.
Es kann also mit beiden Klassen gleichweise kommunizieren.