import { RouterModule, Routes } from '@angular/router';

const app_routes: Routes = [
  { path: 'customers/:id', loadChildren: ''},
  { path: '**', pathMatch:'full', redirectTo: '' } //catch any unfound routes and redirect to home page
];

export const app_routing = RouterModule.forRoot(app_routes);
