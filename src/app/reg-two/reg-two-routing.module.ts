import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { RegTwoPage } from './reg-two.page';

const routes: Routes = [
  {
    path: '',
    component: RegTwoPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class RegTwoPageRoutingModule {}
