import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  { path: '', redirectTo: 'home', pathMatch: 'full' },
  { path: 'home', loadChildren: () => import('./home/home.module').then( m => m.HomePageModule)},
  {
    path: 'about',
    loadChildren: () => import('./about/about.module').then( m => m.AboutPageModule)
  },
  {
    path: 'contact',
    loadChildren: () => import('./contact/contact.module').then( m => m.ContactPageModule)
  },
  {
    path: 'splash',
    loadChildren: () => import('./splash/splash.module').then( m => m.SplashPageModule)
  },
  {
    path: 'reg-one',
    loadChildren: () => import('./reg-one/reg-one.module').then( m => m.RegOnePageModule)
  },
  {
    path: 'reg-two',
    loadChildren: () => import('./reg-two/reg-two.module').then( m => m.RegTwoPageModule)
  },
  {
    path: 'reg-three',
    loadChildren: () => import('./reg-three/reg-three.module').then( m => m.RegThreePageModule)
  },
  {
    path: 'reg-four',
    loadChildren: () => import('./reg-four/reg-four.module').then( m => m.RegFourPageModule)
  },
  {
    path: 'reg-five',
    loadChildren: () => import('./reg-five/reg-five.module').then( m => m.RegFivePageModule)
  },
  {
    path: 'personal-info',
    loadChildren: () => import('./personal-info/personal-info.module').then( m => m.PersonalInfoPageModule)
  },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
