(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

var menu = require('./menu.js');

menu.init();

},{"./menu.js":2}],2:[function(require,module,exports){
'use strict';

module.exports = function () {
    var btn = document.getElementById('menu-btn'),
        sidebarInner = document.getElementById('sidebarInner'),
        sidebarTitle = document.getElementById('sidebar__title'),
        sidebar = document.getElementById('sidebar');

    function init() {
        _setUpListners();
    }

    function _setUpListners() {
        btn.addEventListener('click', _toggleMenu);
    }

    function _toggleMenu() {
        this.classList.toggle('sidebar__btn--active');
        sidebarInner.classList.toggle('sidebar__inner--open');
        sidebar.classList.toggle('sidebar--open');
        if (sidebar.classList.contains('sidebar--open')) {
            sidebarTitle.textContent = 'Cкрыть';
        } else {
            sidebarTitle.textContent = 'Посмотреть всех';
        }
    }

    return {
        init: init
    };
}();

},{}]},{},[1])


//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzb3VyY2UvanMvYXBwLmpzIiwic291cmNlL2pzL21lbnUuanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7OztBQ0FBLElBQUksT0FBTyxRQUFRLFdBQVIsQ0FBWDs7QUFFQSxLQUFLLElBQUw7Ozs7O0FDRkEsT0FBTyxPQUFQLEdBQWtCLFlBQVk7QUFDMUIsUUFBSSxNQUFNLFNBQVMsY0FBVCxDQUF3QixVQUF4QixDQUFWO0FBQUEsUUFDSSxlQUFnQixTQUFTLGNBQVQsQ0FBd0IsY0FBeEIsQ0FEcEI7QUFBQSxRQUVJLGVBQWUsU0FBUyxjQUFULENBQXdCLGdCQUF4QixDQUZuQjtBQUFBLFFBR0ksVUFBVyxTQUFTLGNBQVQsQ0FBd0IsU0FBeEIsQ0FIZjs7QUFLQSxhQUFTLElBQVQsR0FBaUI7QUFDYjtBQUNIOztBQUVELGFBQVMsY0FBVCxHQUEyQjtBQUN2QixZQUFJLGdCQUFKLENBQXFCLE9BQXJCLEVBQThCLFdBQTlCO0FBQ0g7O0FBRUQsYUFBUyxXQUFULEdBQXVCO0FBQ25CLGFBQUssU0FBTCxDQUFlLE1BQWYsQ0FBc0Isc0JBQXRCO0FBQ0EscUJBQWEsU0FBYixDQUF1QixNQUF2QixDQUE4QixzQkFBOUI7QUFDQSxnQkFBUSxTQUFSLENBQWtCLE1BQWxCLENBQXlCLGVBQXpCO0FBQ0EsWUFBSSxRQUFRLFNBQVIsQ0FBa0IsUUFBbEIsQ0FBMkIsZUFBM0IsQ0FBSixFQUFpRDtBQUM3Qyx5QkFBYSxXQUFiLEdBQTJCLFFBQTNCO0FBQ0gsU0FGRCxNQUVPO0FBQ0gseUJBQWEsV0FBYixHQUEyQixpQkFBM0I7QUFDSDtBQUNKOztBQUVELFdBQU87QUFDSCxjQUFNO0FBREgsS0FBUDtBQUlILENBN0JnQixFQUFqQiIsImZpbGUiOiJidW5kbGUuanMiLCJzb3VyY2VSb290IjoiL3NvdXJjZS8iLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24gZSh0LG4scil7ZnVuY3Rpb24gcyhvLHUpe2lmKCFuW29dKXtpZighdFtvXSl7dmFyIGE9dHlwZW9mIHJlcXVpcmU9PVwiZnVuY3Rpb25cIiYmcmVxdWlyZTtpZighdSYmYSlyZXR1cm4gYShvLCEwKTtpZihpKXJldHVybiBpKG8sITApO3ZhciBmPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIrbytcIidcIik7dGhyb3cgZi5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGZ9dmFyIGw9bltvXT17ZXhwb3J0czp7fX07dFtvXVswXS5jYWxsKGwuZXhwb3J0cyxmdW5jdGlvbihlKXt2YXIgbj10W29dWzFdW2VdO3JldHVybiBzKG4/bjplKX0sbCxsLmV4cG9ydHMsZSx0LG4scil9cmV0dXJuIG5bb10uZXhwb3J0c312YXIgaT10eXBlb2YgcmVxdWlyZT09XCJmdW5jdGlvblwiJiZyZXF1aXJlO2Zvcih2YXIgbz0wO288ci5sZW5ndGg7bysrKXMocltvXSk7cmV0dXJuIHN9KSIsInZhciBtZW51ID0gcmVxdWlyZSgnLi9tZW51LmpzJyk7XG5cbm1lbnUuaW5pdCgpOyIsIm1vZHVsZS5leHBvcnRzID0gKGZ1bmN0aW9uICgpIHtcbiAgICBsZXQgYnRuID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ21lbnUtYnRuJyksXG4gICAgICAgIHNpZGViYXJJbm5lciAgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnc2lkZWJhcklubmVyJyksXG4gICAgICAgIHNpZGViYXJUaXRsZSA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdzaWRlYmFyX190aXRsZScpLFxuICAgICAgICBzaWRlYmFyICA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdzaWRlYmFyJyk7XG5cbiAgICBmdW5jdGlvbiBpbml0ICgpIHtcbiAgICAgICAgX3NldFVwTGlzdG5lcnMoKTtcbiAgICB9XG5cbiAgICBmdW5jdGlvbiBfc2V0VXBMaXN0bmVycyAoKSB7XG4gICAgICAgIGJ0bi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIF90b2dnbGVNZW51KTtcbiAgICB9XG5cbiAgICBmdW5jdGlvbiBfdG9nZ2xlTWVudSgpIHtcbiAgICAgICAgdGhpcy5jbGFzc0xpc3QudG9nZ2xlKCdzaWRlYmFyX19idG4tLWFjdGl2ZScpO1xuICAgICAgICBzaWRlYmFySW5uZXIuY2xhc3NMaXN0LnRvZ2dsZSgnc2lkZWJhcl9faW5uZXItLW9wZW4nKTtcbiAgICAgICAgc2lkZWJhci5jbGFzc0xpc3QudG9nZ2xlKCdzaWRlYmFyLS1vcGVuJyk7XG4gICAgICAgIGlmIChzaWRlYmFyLmNsYXNzTGlzdC5jb250YWlucygnc2lkZWJhci0tb3BlbicpKSB7XG4gICAgICAgICAgICBzaWRlYmFyVGl0bGUudGV4dENvbnRlbnQgPSAnQ9C60YDRi9GC0YwnO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgc2lkZWJhclRpdGxlLnRleHRDb250ZW50ID0gJ9Cf0L7RgdC80L7RgtGA0LXRgtGMINCy0YHQtdGFJztcbiAgICAgICAgfVxuICAgIH1cblxuICAgIHJldHVybiB7XG4gICAgICAgIGluaXQ6IGluaXRcbiAgICB9O1xuXG59KSgpO1xuIl19
