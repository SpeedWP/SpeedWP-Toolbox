# WordPress-Artikel für Google+ und Facebook aufbereiten

Google+ und Facebook-Snippets bestehen aus Titel, Beschreibung und Bild. Mit wenig Code können diese Daten in WordPress aufbereitet werden.

Die Google-Suche wird sozialer. Google+ wird dabei intensiver als Quelle für personalisierte Suchergebnisse herangezogen. Für Blogger ein wichtiger Grund, Blog-Artikel mit der Sozial-Plattform der Suchmaschine stärker, nahtloser zu verknüpfen und zusätzlich für ein reges Teilen redaktioneller Nachrichten zu sorgen. Dabei spielen Metadaten einer Google+ Mitteilung (Titel, Kurzbeschreibung, Bild auch +Snippet genannt) eine nicht unwichtige Rolle, den genau diese Information trägt der Entscheidung bei, ob eine Mitteilung weitergereicht wird. Wie ein WordPress-Post richtig formatiert gehört, um in eine makellose aussehende und von der Länge passende Google+ Mitteilung verwandelt zu werden, zeigt dieser Artikel.

## Hervorhebungen im Quelltext

Beim Eintragen einer Webadresse in das dafür vorgesehene Feld (alternativ bei direkter Eingabe im Mitteilungstext) sendet Google+ unverzüglich eine Anfrage an die hinterlassene Webseite. Dabei versucht Google Metainformationen für das +Snippet zu extrahieren. Dazu gehören: Ein Titel, eine Kurzbeschreibung und ein Vorschaubild.

Damit notwendige Daten schnell und zuverlässig erkannt und als Snippet verfügbar sind, empfiehlt Google eine Auszeichnung der einzelnen Werte direkt im Quelltext der Webseiten. Hierfür stehen zwei Möglichkeiten parat:

* Im `<head>` einer Blogseite als Metatag. Betroffen ist das WordPress-Template header.php
* Im `<body>` bzw. direkt bei der Ausgabe des Artikelinhalts im WordPress-Loop. Betroffen ist single.php

Die zweite Methode ist klar zu bevorzugen, da die Auszeichnungen im Template nur platziert, jedoch nicht befüllt werden müssen. Zu beachten ist ebenfalls die Obergrenze von 200 Zeichen für eine Kurzbeschreibung, da Google diese im Snippet sonst kürzt.

## SEO-Metadaten als Referenz

WordPress SEO Plugin Nutzer können sich die Mühe mit der Platzierung der Markierungen im Code sparen, denn Google wertet auch die Standard-Metadaten wie den Seitentitel (title-Tag) und die Seitenbeschreibung (Meta-Tag description) einer Blogseite aus. Die beiden Werte generiert das Plugin eh für Suchmaschinen, Google+ und Facebook bedienen sich lediglich an der Quelle.

Die empfohlene Länge der manuellen Metabeschreibungen im SEO-Plugin von 140 Zeichen zeigt hier ihre wahre Stärke: die von Google übernommene Kurzbeschreibung passt ausgezeichnet ins Snippet-Design. Dazu Thumbnail im Snippet

Für eine vollendete Optik eines gelungenen Google+ Snippet fehlt eine Bildvorschau für den verknüpften Blog-Artikel. Auch für diesen Zweck hält Google eine entsprechende Auszeichnung nach dem gleichen Muster parat: Als Meta oder im Loop können Bilder im Artikel zur Nutzung im Snippet gekennzeichnet werden.

Für Vorschaubilder im Snippet benötigt Google+ ausschliesslich Bilder mit einer Mindesthöhe von 120 Pixel. Ist das festgelegte Artikelbild kleiner, wird es nicht verwendet und Google+ sucht sich eine passendere Grafik innerhalb der Webseite raus. Ist das Bild dagegen zu groß, skaliert Google automatisch auf die vorgegebene Höhe.

Wer Theme-interne Templates nicht anfassen mag oder kann, nutzt einfach das nachfolgende Toolbox-Modul, welches Artikelbilder im Open Graph Protocol als Metatag og:image ausgibt und Google+ (bei richtigen html-Attributen auch für Facebook) somit ein brauchbares Vorschaubild zur Verfügung stellt. Bitte Hinweise am Seitenende beachten.

## Toolbox-Modul für Artikelbilder als Metatag

```php
<?php
/*
Module Name: Ausgabe der Artikelbilder als og:image Metatag
Module URI: http://playground.ebiene.de/wordpress-google-plus/
Description: Fügt dem Head-Bereich ein og:image-Metatag mit aktuellem Artikelbild zu. [Frontend]
Author: Sergej Müller
Author URI: http://wpcoder.de
*/
 
 
/* Sicherheitsabfrage */
if ( ! class_exists(Toolbox) ) {
	die();
}
 
 
/* Ab hier kanns los gehen */
function sm_meta_thumb() {
	/* Keine Feeds und X-Backs */
	if ( is_feed() or is_trackback() ) {
		return;
	}
 
	/* Beiträge mit Thumbs */
	if ( is_singular() && has_post_thumbnail() ) {
		$image = wp_get_attachment_image_src(
			get_post_thumbnail_id()
		);
 
		$thumb = $image[0];
 
	/* Default Thumb */
	} else {
		$thumb = http://cdn.wpseo.de/website/v3/img/logo/120x120.png;
	}
 
	/* Ausgabe */
	echo sprintf(
		%s<meta property="og:image" content="%s" />,
		"\n",
		esc_attr($thumb)
	);
}
 
/* Fire */
add_action(
	wp_head,
	sm_meta_thumb
);
```

Hinweise

Die Ausgabe erfolgt ausschließlich auf Seiten mit Artikelbildern. Auf restlichen Seiten im Blog (Startseite, Archiv, etc.) gibt das Modul ein Standard-Thumbnail aus, welches im Modul-Schnipsel als Pfad angepasst werden sollte.
Aufruf der WordPress-Funktion wp_head() muss in header.php stattfinden.

Testing

Das Ergebnis lässt sich wahlweise direkt in Google+ durch die Eingabe einer URL (ohne abzusenden) testen. Oder mithilfe des [Google Snippet Tools](https://search.google.com/structured-data/testing-tool/u/0/).