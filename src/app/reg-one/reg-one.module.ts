import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { RegOnePageRoutingModule } from './reg-one-routing.module';

import { RegOnePage } from './reg-one.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    RegOnePageRoutingModule
  ],
  declarations: [RegOnePage]
})
export class RegOnePageModule {}
