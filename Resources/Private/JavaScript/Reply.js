(function () {

  class ReplyHandler {

    constructor(field, form) {
      this.field = field;
      this.form = (form || (!Element.prototype.closest ? null : field.closest('form')));
      this.formWrap = this.form ? this.form.parentNode : null;
      this.formWrapNextSibling = this.formWrap.nextElementSibling || this.formWrap.parentNode.appendChild(document.createElement('div'));
      this.titleWrap = null;
    }

    unset(resetFormOriginalPosition) {

      // Clear value in field
      this.field.value = 0;

      // Remove title
      this.titleWrap.parentNode.removeChild(this.titleWrap);
      this.titleWrap = null;

      // Return form to the original position
      if(resetFormOriginalPosition && this.formWrap) {
        this.formWrapNextSibling.parentNode.insertBefore(this.formWrap, this.formWrapNextSibling);
      }
    }

    set(value, link, appendFormToComment) {

      // Parse given value to an integer
      const id = parseInt(value);

      // Replace the value
      this.field.value = id;

      // Change position of form element
      if (appendFormToComment && this.formWrap) {
        link.parentNode.appendChild(this.formWrap);
      }

      // Add element
      if (link.title) {

        // Create new node or use existing
        const titleWrap = (this.titleWrap ? Zeroseven.Blog.Utility.removeChilds(this.titleWrap) : document.createElement('h3')); // At this point, SEO isn't that important as the crawler doesn't go through reply links.
        titleWrap.className = 'js-comment-reply-title';
        titleWrap.role = 'status';
        titleWrap.textContent = link.title + ' '; // Clear the titleWrap, set title and add space for the close icon

        const clear = titleWrap.appendChild(document.createElement('a'));
        clear.className = 'js-comment-reply-clear';
        clear.textContent = '×';
        clear.href = 'javascript:void(0)';
        clear.addEventListener('click', () => {
          this.unset(appendFormToComment);
        });

        // Add wrapper to the dom
        if(!this.titleWrap) {
          this.field.parentNode.insertBefore(titleWrap, this.field);
        }

        // Store the titleWrap
        this.titleWrap = titleWrap;
      }

      // Scroll to the form
      (this.form || this.field.parentNode).scrollIntoView({
        behavior: 'smooth'
      });

    }
  }

  let temporaryInstaces = {};

  const getInstance = (field, form) => {

    // Get hash of current view (in case, that you change page content by ajax request …)
    const key = btoa(location.href);

    if(temporaryInstaces[key]) {
      return temporaryInstaces[key];
    }

    return temporaryInstaces[key] = new ReplyHandler(field, form);
  };

  const reply = (fieldSelector, value, appendFormToComment, target, e) => {

    // Initialize ReplyHandler
    const event = e || window.event;
    const replyHandler = getInstance(document.querySelector(fieldSelector))

    // Prevent event
    if (typeof event !== 'undefined') {
      event.preventDefault();
    }

    // And action!
    replyHandler.set(value, (target || event.target), appendFormToComment);

  };

  // Make reply function accessible
  Zeroseven.Blog.Utility.register('reply', reply);
})();
