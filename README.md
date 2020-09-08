# Comments (z7_blog)

**Erweitere die Blog-Erweiterung um eine Kommentar-Funktion.**

Einfache verwaltung von Kommentaren über automatische E-Mail-Benachrichtigung oder über das TYPO3-Backend.

## Sprach-Konzept

Kommentare sind wichtige User-Signale die auch auf schwächer besuchten Übersetzungen nicht fehlen sollten. 
Daher werden diese über alle Sprachen hinweg angezeigt. 

Damit dies für SEO und Screenreader keine Probleme darstellt, werden Kommentare automatisch mit der jeweiligen Sprache gekennzeichnet.

## Basierend auf der "form"-Erweiterung

Das Formular basiert auf der [TYPO3 form-Erweiterung](https://docs.typo3.org/c/typo3/cms-form/master/en-us/). Dies ermöglicht es dir zusätzliche Felder, Finisher, Validator, etc hinzuzufügen. 
Darüber hinaus steht dir eine umfassende Dokumentation bereit. 

Ist die form-Erweiterung im Projekt schon im Einsatz, könnte ein bereits fertig gestyltes Kommentar-Formular noch ein ganz angenehmer Nebeneffekt sein.

## Kommentare integrieren

–

## Todo's

* Einfacher Spam-Schutz (über `TypoScriptFrontendController->TypoScriptFrontendController` möglich)
* Widget
* Comment reply function in frontend
* Frontend ausgabe
