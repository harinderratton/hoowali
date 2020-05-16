import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { RegFourPage } from './reg-four.page';

const routes: Routes = [
  {
    path: '',
    component: RegFourPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class RegFourPageRoutingModule {}
