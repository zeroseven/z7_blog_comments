# Comment function for the [z7_blog](https://github.com/zeroseven/z7_blog)

With this extension you can extend your blog with a comment function.  
For all comments to be easily managed by you, this extension supports you with notifications via email, a dashboard widget and further settings directly in your blog posts.

## :lollipop: Feature overview

* Email notifications
* Dashboard widget
* Automatic language detection of comments
* Reply function
* Extension of structured data
* Automatic captcha

## :capital_abcd: Language concept

Comments are important user signals that shouldn't be missed on translated pages with less traffic. Therefore, comments are displayed across all page translations.

For this to not be a problem with your SEO or screenreader compatibility, comments will be automatically tagged with their corresponding language.

##:memo: Based on the TYPO3 form extension

The comment form is based on the [TYPO3 form extension](https://docs.typo3.org/c/typo3/cms-form/master/en-us/). This enables you to add additional fields, finishers or validators as you wish. To add to this, there's also a comprehensive documentation for it available.

Is the form extension already in your project, an already styled comment form might be nice side effect.

## :wrench: Installation

Get this extension via `composer req zeroseven/z7-blog-comments`.

## :gear: Setup

### Integrate comments

You can achieve this via typoscript or via a ViewHelper. For more information on this, please check the README of our [z7_blog](https://github.com/zeroseven/z7_blog) extension.

Here is an example for an integration in fluid:

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

### Extend comments

All you have to do for this, is to extend the domain model of Comment and use this new property as the identifier for the corresponding form field.
When sending a form, all entered data will be assigned to the corresponding properties in the domain model and saved to the database.

### Configure form:

There's not much to do here. It's advised to override the form and finisher to fit your needs in the project. 
To use another form, you can alter this TypoScript constant `plugin.tx_z7blog.settings.comments.form` or [override the existing formDefinition in your TypoScript setup](https://docs.typo3.org/c/typo3/cms-form/master/en-us/I/Concepts/FrontendRendering/Index.html#typoscript-overrides) like shown the following example:

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
