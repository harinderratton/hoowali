import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { RegThreePageRoutingModule } from './reg-three-routing.module';

import { RegThreePage } from './reg-three.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    RegThreePageRoutingModule
  ],
  declarations: [RegThreePage]
})
export class RegThreePageModule {}
