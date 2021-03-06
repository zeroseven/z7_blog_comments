/**
 * Module: TYPO3/CMS/Z7BlogComments/Backend/PendingCommentsWidget
 */
require(['TYPO3/CMS/Core/Ajax/AjaxRequest', 'TYPO3/CMS/Backend/Tooltip', 'TYPO3/CMS/Core/Event/RegularEvent', 'TYPO3/CMS/Backend/InfoWindow', 'TYPO3/CMS/Backend/Notification'], function (AjaxRequest, Tooltip, RegularEvent, InfoWindow, Notification) {

  /** @var string */
  const tableName = 'tx_z7blog_domain_model_comment';

  /**
   * Handle requests
   *
   * @param uid
   * @param updateFields
   * @param commands
   * @param callback
   * @return void
   */
  const handleRequest = function (uid, updateFields, commands, callback) {

    // Define arguments
    let queryArguments = {'data': {}};
    queryArguments.data[tableName] = {};
    queryArguments.data[tableName][uid] = {
      'pending': 0
    };

    // Add fields to update
    if (updateFields && typeof updateFields === 'object') {
      Object.keys(updateFields).forEach(key => {
        queryArguments.data[tableName][uid][key] = updateFields[key];
      });
    }

    // Add commands
    if (commands && typeof commands === 'object') {
      queryArguments = {'cmd': {}};
      queryArguments.cmd[tableName] = {};
      queryArguments.cmd[tableName][uid] = {};

      Object.keys(commands).forEach(key => {
        queryArguments.cmd[tableName][uid][key] = commands[key];
      });
    }

    // Process request
    new AjaxRequest(TYPO3.settings.ajaxUrls.record_process).withQueryArguments(queryArguments).get().then(async function (response) {
      const result = await response.resolve();

      // Call callback function
      if (typeof callback === 'function') {
        callback(result);
      }
    });
  };

  /**
   * Handle resolve
   *
   * @param resolve
   * @param state
   * @param message
   * @param target
   * @return void
   */
  const handleResult = function (resolve, state, message, target) {
    if(resolve.hasErrors) {
      Notification.error(resolve.messages && resolve.messages[0] && resolve.messages[0].title ? resolve.messages[0].title : null, resolve.messages && resolve.messages[0] && resolve.messages[0].message ? resolve.messages[0].message : 'An error occurred');
    } else {
      Notification[state](null, message, 4);
      removeItem(target);
    }
  };

  /**
   * Enable comment
   *
   * @param uid
   * @param element
   * @return bool
   */
  const enableComment = function (uid, element) {
    const target = element || window.event.target;
    return handleRequest(parseInt(uid), {hidden: 0}, null, function (result) {
      handleResult(result, 'success', TYPO3.lang['control.enabled'], target);
    });
  };

  /**
   * Reject comment
   *
   * @param uid
   * @param element
   * @return bool
   */
  const rejectComment = function (uid, element) {
    const target = element || window.event.target;
    return handleRequest(parseInt(uid), null, null, function (result) {
      handleResult(result, 'info', TYPO3.lang['control.rejected'], target);
    });
  };

  /**
   * Delete comment
   *
   * @param uid
   * @param element
   * @return bool
   */
  const deleteComment = function (uid, element) {
    const target = element || window.event.target;
    return handleRequest(parseInt(uid), null, {delete: 1}, function (result) {
      handleResult(result, 'info', TYPO3.lang['control.deleted'], target);
    });
  };

  /**
   * Open info overlay
   *
   * @param uid
   * @return void
   */
  const showInfo = function (uid) {
    InfoWindow.showItem(tableName, uid);
  };

  /**
   * Remove item
   *
   * @param target
   */
  const removeItem = function (target) {
    const item = target ? target.closest('.js-pending-comment-item') : null;

    if (item) {
      item.parentNode.removeChild(item);
    }
  };

  // Show tooltip on some elements when the widget has loaded
  new RegularEvent("widgetContentRendered", (function (e) {
    e.preventDefault();

    Tooltip.initialize('[title]', {
      trigger: 'hover',
      title: function () {
        return this.dataset.tooltip;
      }
    });
  })).delegateTo(document, '.dashboard-item')

  // Add class to the context
  TYPO3 = TYPO3 || {};
  TYPO3.Blog = TYPO3.Blog || {};
  TYPO3.Blog.PendingComments = {
    'enable': enableComment,
    'reject': rejectComment,
    'delete': deleteComment,
    'info': showInfo
  };
});
