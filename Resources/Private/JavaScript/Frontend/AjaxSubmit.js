Zeroseven.Blog.Utility.register('ajaxSubmit', (f, e) => {

  // Define variables
  const event = e || window.event;
  const form = f || event.target;
  const Utility = Zeroseven.Blog.Utility;

  // Stop default behaviour of the event
  if (typeof event !== 'undefined') {
    event.preventDefault();
  }

  // Collect params (working on simple forms only)
  let params = {};
  [].concat([...form.getElementsByTagName('input')], [...form.getElementsByTagName('textarea')], [...form.getElementsByTagName('select')], [...form.getElementsByTagName('button')]).forEach(field => {
    if (field.name) {
      params[field.name] = field.value;
    }
  });

  // Set styles
  form.style.opacity = '0.5';
  form.style.pointerEvents = 'none';

  // Send form and replace content
  Utility.loadContents(form.action, params, (contents, requestStatus) => {
    if (requestStatus < 400 && contents) {
      Object.keys(contents).forEach(key => Utility.appendChilds(contents[key].parentNode, Utility.removeChilds(form.parentNode)));
    } else {
      return confirm('The form could not be send:\n' + requestStatus.text + ' (code:' + requestStatus.code + ').\n\nDo you want to reload the page?') && window.location.reload();
    }
  }, '#' + form.id);

});
