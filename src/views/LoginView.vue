<template>
  <div>
    <div>
      <form>
        <h3>Logowanie</h3>
        <p>
          Jeśli masz już konto, możesz zalogować się przy pomocy loginu lub
          emaila.
        </p>
        <div>
          <label>Login / email</label>
          <input type="text" />
        </div>
        <div>
          <label>Hasło</label>
          <input type="password" />
        </div>
        <div>
          <button type="submit">Zaloguj się</button>
        </div>
      </form>
    </div>
    <div>
      <h3>Rejestracja</h3>
      <p>Utwórz konto, aby uzyskać dostęp do aplikacji.</p>
      <router-link :to="{ name: 'RegisterView' }">
        Chcę utworzyć konto
      </router-link>
    </div>
  </div>
</template>
