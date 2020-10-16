# Kommentar-Funktion für [z7_blog](https://github.com/zeroseven/z7_blog)

Mit dieser Erweiterung kannst du deinen Blog um eine Kommentar-Funktion erweitern. 
Damit sich Kommentare für dich möglichst einfach verwalten lassen, unterstützt dich diese Erweiterung mit E-Mailbenachrichtigen, einem Dashboard Widget und weiteren Einstellungsmöglichkeiten direkt in den Posts.   

## :lollipop: Feature overview

* E-Mailbenachrichtigungen
* Dashboard Widget
* Automatische Spracherkennung
* Antworten auf Kommentare möglich
* Erweiterung von Strukturierten Daten
* Automatischer Captcha

## :capital_abcd: Sprach-Konzept

Kommentare sind wichtige User-Signale die auch auf schwächer besuchten Übersetzungen nicht fehlen sollten. 
Daher werden diese über alle Sprachen hinweg angezeigt. 

Damit dies für SEO und Screenreader keine Probleme darstellt, werden Kommentare automatisch mit der jeweiligen Sprache gekennzeichnet.

##:memo: Basierend auf der TYPO3 "form"-Erweiterung

Das Formular basiert auf der [TYPO3 form-Erweiterung](https://docs.typo3.org/c/typo3/cms-form/master/en-us/). Dies ermöglicht es dir zusätzliche Felder, Finisher, Validator, etc hinzuzufügen. 
Darüber hinaus steht dir eine umfassende Dokumentation bereit. 

Ist die form-Erweiterung im Projekt schon im Einsatz, könnte ein bereits fertig gestyltes Kommentar-Formular noch ein ganz angenehmer Nebeneffekt sein.

## :wrench: Installation

Get this extension via `composer req zeroseven/z7-blog-comments`.

## :gear: Setup

### Kommentare integrieren

Dies kannst du per TypoScript oder über einen ViewHelper machen. Für mehr Infos schau dazu in die README der Erweiterung [z7_blog](https://github.com/zeroseven/z7_blog).

Hier ein Beispiel für die Integration in fluid:

```html
<html xmlns:blog="http://typo3.org/ns/Zeroseven/Z7Blog/ViewHelpers" data-namespace-typo3-fluid="true">
    <main>
        <h1>{page.title}</h1>
        
        ...

        <f:comment><!-- Render comments on blog post pages--></f:comment>
        <blog:postInfo file="EXT:z7_blog_comments/Resources/Private/Partials/Post/Info/Comments.html" />
    </main>
</html>
```

### Kommentare erweitern

Alles was du dafür machen musst, ist es zuerst das Comment-Domain-Model zu erweitern. Den Name einer neuen Property musst du dann nur noch als indentifer entsprechend für ein neues Formular-Feld verwenden.
Beim Versenden des Formulars werden für alle Eingabe-Daten anhand des identifiers die enstsprechenden Propertis im Domain-Model gefüllt und in die Datenbank gespeichert. 

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
