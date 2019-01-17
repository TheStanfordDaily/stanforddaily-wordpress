(function(api){
  
  if ( ! api.activeCallback ) {
    api.activeCallback = {};
  }
  
  /**
   * Compare value
   *
   * @param value1
   * @param value2
   * @param compare
   * @returns {boolean}
   */
  api.activeCallback.compare = function(value1, value2, compare){
    if (compare === '===') {
      return value1 === value2;
    }
  
    if (compare === '=' || compare === '==' || compare === 'equals' || compare === 'equal') {
      return value1 == value2;
    }
  
    if (compare === '!=') {
      return value1 !== value2;
    }
  
    if (compare === '!=' || compare === 'not equal') {
      return value1 != value2;
    }
  
    if (compare === '>=' || compare === 'greater or equal' || compare === 'equal or greater') {
      return value1 >= value2;
    }
  
    if (compare === '<=' || compare === 'smaller or equal' || compare === 'equal or smaller') {
      return value1 <= value2;
    }
  
    if (compare === '>' || compare === 'greater') {
      return value1 > value2;
    }
  
    if (compare === '<' || compare === 'smaller') {
      return value1 < value2;
    }
  
    if (compare === 'in' || compare === 'contains') {
      var result = value1.indexOf(value2);
      return result >= 0;
    }
  };
  
  /**
   * Get status for given rule
   *
   * @param rules
   * @returns {boolean}
   */
  api.activeCallback.getStatus = function(rules){
    var flag = true;
  
    _.each(rules, function (rule) {
      var control = api.control(rule.setting);
      if(control) {
        var setting = api.control(rule.setting).setting;
        flag = flag && api.activeCallback.compare(rule.value, setting.get(), rule.operator);
      } else {
        console.log("[Active Callback] Control not exist : " + rule.setting);
      }
    });
  
    return flag;
  };
  
  /**
   * set control active status
   *
   * @param control
   * @param rules
   * @returns {*}
   */
  api.activeCallback.setActiveStatus = function(control, rules){
    var active_status = api.activeCallback.getStatus(rules);
    control.active.set(active_status);
    return active_status;
  };
  
  /**
   * Register every rule for active callback
   *
   * @param control
   * @param rules
   */
  api.activeCallback.registerActiveRule = function(control, rules){
    var activeStatus = this.setActiveStatus;
  
    if(control.params.active_rule !== null){
      activeStatus(control, rules);
    
      _.each(rules, function (active) {
        var controlParent = api.control(active.setting);
  
        controlParent.setting.bind(function(){
          var result = activeStatus(control, rules);
          var obj = {
            id: control.params.settings.default,
            result: result
          };
          api.previewer.send('active-callback-control-output', obj);
        });
      
      });
    }
  };
  
  
})(wp.customize);