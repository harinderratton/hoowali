import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { RegFivePageRoutingModule } from './reg-five-routing.module';

import { RegFivePage } from './reg-five.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    RegFivePageRoutingModule
  ],
  declarations: [RegFivePage]
})
export class RegFivePageModule {}
