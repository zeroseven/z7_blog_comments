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

Dies kannst du per TypoScript oder über einen ViewHelper machen. Für mehr Infos schau dazu in die README der Erweiterung z7_blog.

Hier ein Beispiel für die Integration per TypoScript:

```typo3_typoscript
page.131088 = USER
page.131088 {
  userFunc = Zeroseven\Z7Blog\Utility\PostInfoRenderUtility->renderUserFunc
  file = EXT:z7_blog_comments/Resources/Private/Partials/Post/Info/Comments.html
}

```

## Kommentare erweitern

Alles was du hier machen musst ist zuerst das Comment-Domain-Model zu erweitern. Den Name der neuen Property musst du dann nur noch als indentifer für ein neues Formular-Feld verwenden.
Beim Versenden des Formulars werden für alle Eingabe-Daten anhand des identifiers die enstsprechenden Propertis im Domain-Model gefüllt und in der Datenbank gespeichert. 

## Configure the extension

### Configure Form:

Not much to be done here. It's probably wise to override the form and finisher to fit in your project. 
To use another form, you can alter this TypoScript constant `plugin.tx_z7blog.settings.comments.form` or [override the existing formDefinition in your TypoScript setup](https://docs.typo3.org/c/typo3/cms-form/master/en-us/I/Concepts/FrontendRendering/Index.html#typoscript-overrides) like the following example:

```typo3_typoscript
lib.Z7BlogCommentsForm.settings.formDefinitionOverrides.Z7BlogCommentsForm.finishers {
  
  # EmailToReceiver
  3.options {
    recipientAddress = b.a.baracus@ateam.com
    carbonCopyRecipients = john.hannibal.smith@ateam.com, murdock@ateam.com
    senderAddress = webmaster@ateam.com
  }
}
```
