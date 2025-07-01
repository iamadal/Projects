<script lang="ts">
  import Router   from 'svelte-spa-router';
  import { wrap } from 'svelte-spa-router/wrap';
  import NotFound from './routes/404.svelte';

  const routes = {
    '/':                wrap({ asyncComponent: () => import('./routes/index.svelte') }),
    '/users/dashboard': wrap({ asyncComponent: () => import('./routes/users/UserDashboard.svelte')  }),
    '/admin/dashboard': wrap({ asyncComponent: () => import('./routes/admin/AdminDashboard.svelte') }),
    '*': NotFound
  }
</script>


<main>
  <Router {routes} />
</main>
