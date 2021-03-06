# -*- coding: utf-8 -*-

#------------------------------------------#
# Этот файл является частью CMS Cirno v9.0 #
# © 2016 https://github.com/WST            #
# Распространяется на условиях MIT License #
#-------------------------------------------

# Flask
from flask.ext.login import login_user, logout_user, current_user, login_required
from flask import render_template, flash, redirect, session, url_for, request, g

# Наше приложение
from cms import site
from cms.forms import LoginForm
from cms.classes import User

@site.application.before_request
def before_request():
	g.user = current_user

@site.application.route('/login', methods = ['GET', 'POST'])
def login():
	if g.user is not None and g.user.is_authenticated:
		return redirect('/')
	
	form = LoginForm()

	if form.validate_on_submit():
		user = User.authenticate(form.username.data, form.password.data)
		if user is not None:
			login_user(user)
			return redirect('/')
		else:
			return render_template('auth/login-page.htt', title = u'Авторизация', form = form)
	else:
		return render_template('auth/login-page.htt', title = u'Авторизация', form = form)

site.login_manager.login_view = 'login'

@site.application.route("/logout")
@login_required
def logout():
	logout_user()
	return redirect('/')
