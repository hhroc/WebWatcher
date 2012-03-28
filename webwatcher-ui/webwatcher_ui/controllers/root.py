# -*- coding: utf-8 -*-
"""Main Controller"""

from tg import expose, flash, require, url, lurl, request, redirect
from tg.i18n import ugettext as _, lazy_ugettext as l_
from webwatcher_ui import model
from repoze.what import predicates
from webwatcher_ui.model import DBSession, metadata

from webwatcher_ui.lib.base import BaseController
from webwatcher_ui.controllers.error import ErrorController

import tw2.forms as twf

class LoginForm(twf.TableForm):
    login = twf.TextField(css_class="text ui-widget-content ui-corner-all")
    password = twf.PasswordField(css_class="text ui-widget-content ui-corner-all")
    loginremember = twf.CheckBox(label="Remember Login",css_class="ui-widget-content ui-corner-all")
    submit = twf.SubmitButton(value="Login", css_class="ui-button ui-button-text-only ui-corner-all")

__all__ = ['RootController']


class RootController(BaseController):
    """
    The root controller for the webwatcher-ui application.

    All the other controllers and WSGI applications should be mounted on this
    controller. For example::

        panel = ControlPanelController()
        another_app = AnotherWSGIApplication()

    Keep in mind that WSGI applications shouldn't be mounted directly: They
    must be wrapped around with :class:`tg.controllers.WSGIAppController`.

    """
    error = ErrorController()

    @expose('webwatcher_ui.templates.index')
    def index(self):
        """Handle the front-page."""
        return dict(page='index')

    @expose('webwatcher_ui.templates.profile')
    def profile(self):
        if not request.identity:
            redirect('/')

        return dict(page='profile')

    @expose('webwatcher_ui.templates.about')
    def about(self):
        """Handle the 'about' page."""
        return dict(page='about')

    @expose('webwatcher_ui.templates.index')
    @require(predicates.has_permission('manage', msg=l_('Only for managers')))
    def manage_permission_only(self, **kw):
        """Illustrate how a page for managers only works."""
        return dict(page='managers stuff')

    @expose('webwatcher_ui.templates.index')
    @require(predicates.is_user('editor', msg=l_('Only for the editor')))
    def editor_user_only(self, **kw):
        """Illustrate how a page exclusive for the editor works."""
        return dict(page='editor stuff')

    @expose('webwatcher_ui.templates.login')
    def login(self, came_from=lurl('/')):
        """Start the user login."""
        login_counter = request.environ['repoze.who.logins']
        if login_counter > 0:
            flash(_('Wrong credentials'), 'warning')
        return dict(page='login', login_counter=str(login_counter),
                    came_from=came_from)

    @expose()
    def post_login(self, came_from=lurl('/')):
        """
        Redirect the user to the initially requested page on successful
        authentication or redirect her back to the login page if login failed.

        """
        if not request.identity:
            login_counter = request.environ['repoze.who.logins'] + 1
            redirect('/login',
                params=dict(came_from=came_from, __logins=login_counter))
        userid = request.identity['repoze.who.userid']
        flash(_('Welcome back, %s!') % userid)
        redirect(came_from)


    @expose()
    def logout(self, came_from=lurl('/')):
        redirect('/logout_handler', params=dict(came_from=came_from))

    @expose()
    def post_logout(self, came_from=lurl('/')):
        """
        Redirect the user to the initially requested page on logout and say
        goodbye as well.

        """
        flash(_('We hope to see you soon!'))
        redirect(came_from)
