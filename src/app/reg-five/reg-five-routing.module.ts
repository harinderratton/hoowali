import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { RegFivePage } from './reg-five.page';

const routes: Routes = [
  {
    path: '',
    component: RegFivePage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class RegFivePageRoutingModule {}
