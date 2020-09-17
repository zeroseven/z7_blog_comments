/**
 * Module: TYPO3/CMS/Z7BlogComments/Backend/PendingCommentsWidget
 */
require(['TYPO3/CMS/Core/Ajax/AjaxRequest', 'TYPO3/CMS/Backend/Tooltip', 'TYPO3/CMS/Core/Event/RegularEvent'], function (AjaxRequest, Tooltip, RegularEvent) {

  var PendingComments = {};

  /** @var string */
  PendingComments.tableName = 'tx_z7blog_domain_model_comment';

  /**
   * Handle requests
   *
   * @param uid
   * @param updateFields
   * @param commands
   * @param callback
   * @return bool
   */
  PendingComments.request = function (uid, updateFields, commands, callback) {

    // Define arguments
    var queryArguments = {'data': {}};
    queryArguments.data[PendingComments.tableName] = {};
    queryArguments.data[PendingComments.tableName][uid] = {
      'pending': 0
    };

    // Add fields to update
    if(updateFields && typeof updateFields === 'object') {
      Object.keys(updateFields).forEach(key => {
        queryArguments.data[PendingComments.tableName][uid][key] = updateFields[key];
      });
    }

    // Add commands
    if (commands && typeof commands === 'object') {
      queryArguments = {'cmd': {}};
      queryArguments.cmd[PendingComments.tableName] = {};
      queryArguments.cmd[PendingComments.tableName][uid] = {};

      Object.keys(commands).forEach(key => {
        queryArguments.cmd[PendingComments.tableName][uid][key] = commands[key];
      });
    }

    // Process request
    new AjaxRequest(TYPO3.settings.ajaxUrls.record_process).withQueryArguments(queryArguments).get().then(async function (response) {
      const resolved = await response.resolve();

      // Call callback function
      if(typeof callback === 'function') {
        callback(resolved);
      }

      // Return state
      return resolved.hasErrors;
    });
  };

  /**
   * Enable comment
   *
   * @param uid
   * @param element
   * @return bool
   */
  PendingComments.enable = function (uid, element) {
    var target = element || window.event.target;
    return PendingComments.request(parseInt(uid), {hidden: 0}, null, function() {
      PendingComments.removeItem(target);
    });
  };

  /**
   * Reject comment
   *
   * @param uid
   * @param element
   * @return bool
   */
  PendingComments.reject = function (uid, element) {
    var target = element || window.event.target;
    return PendingComments.request(parseInt(uid), null, null, function() {
      PendingComments.removeItem(target);
    });
  };

  /**
   * Delete comment
   *
   * @param uid
   * @param element
   * @return bool
   */
  PendingComments.delete = function (uid, element) {
    var target = element || window.event.target;
    return PendingComments.request(parseInt(uid), null, {delete: 1}, function() {
      PendingComments.removeItem(target);
    });
  };

  /**
   * Remove item
   *
   * @param target
   */
  PendingComments.removeItem = function (target) {
    var item = target ? target.closest('.js-pending-comment-item') : null;

    if(item) {
      item.parentNode.removeChild(item);
    }
  };

  // Show tooltip
  new RegularEvent("widgetContentRendered", (function (e) {
    e.preventDefault();

    // Tooltip.initialize();
    Tooltip.initialize('[data-tooltip]', {
      trigger: 'hover',
      title: function() {return this.dataset.tooltip; }
    });
  })).delegateTo(document, '.dashboard-item')

  // Add class to the context
  TYPO3 = TYPO3 || {};
  TYPO3.Blog = TYPO3.Blog || {};
  TYPO3.Blog.PendingComments = PendingComments;

  // Return the object
  return PendingComments;
});
