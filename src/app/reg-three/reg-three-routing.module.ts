import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { RegThreePage } from './reg-three.page';

const routes: Routes = [
  {
    path: '',
    component: RegThreePage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class RegThreePageRoutingModule {}
