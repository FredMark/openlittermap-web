<template>
	<div>
		<p v-show="errorLogin" style="color: red;">{{ errorLogin }}</p>

		<form role="form" method="post" @submit.prevent="login" style="padding: 1em 2em;">

			<input
				class="input mb1em fs125"
				placeholder="you@email.com"
				type="email"
				name="email"
				required
				v-model="email"
				@keydown="clearLoginError"
				autocomplete="email"
			/>

			<input
				class="input mb1em fs125"
				placeholder="Your Password"
				type="password"
				name="password"
				required
				v-model="password"
				@keydown="clearPwError"
				autocomplete="current-password"
			/>

			<button :class="button" :disabled="processing">Login</button>
		 </form>

        <footer class="modal-card-foot" style="height: 50px;">
            <div class="column is-half">
                <a href="/signup">Sign up</a>
            </div>

            <div class="column is-half">
                <a href="/password/reset" class="has-text-right">Forgot Password?</a>
            </div>
        </footer>
	 </div>
</template>

<script>
export default {
	name: 'Login',
	data ()
	{
		return {
			email: '',
			password: '',
			processing: false,
			btn: 'button is-medium is-primary'
		};
	},
	computed: {

		/**
		 * Add ' is-loading' when processing is true
		 */
		button ()
		{
			return this.processing ? this.btn + ' is-loading' : this.btn;
		},

        /**
         * Get errors from login (email)
         */
        errorLogin ()
        {
            return this.$store.state.user.errorLogin;
        }
	},
	methods: {

	    /**
         *
         */
        clearLoginError ()
        {
            this.$store.commit('errorLogin', '');
        },

		/**
		 * Try to log the user in
		 */
		async login ()
		{
			this.processing = true;

			await this.$store.dispatch('LOGIN', {
				email: this.email,
				password: this.password
			});

			this.processing = false;
        },

		/**
		 * Remove password errors
		 */
		clearPwError ()
		{
        	this.error = false;
        	this.errormessage = '';
        }
	},
}
</script>


<style>

	.fs125 {
		font-size: 1.25em;
	}
</style>
