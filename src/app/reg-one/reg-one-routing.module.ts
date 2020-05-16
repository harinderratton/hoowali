import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { RegOnePage } from './reg-one.page';

const routes: Routes = [
  {
    path: '',
    component: RegOnePage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class RegOnePageRoutingModule {}
