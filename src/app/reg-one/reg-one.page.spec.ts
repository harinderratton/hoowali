import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { RegOnePage } from './reg-one.page';

describe('RegOnePage', () => {
  let component: RegOnePage;
  let fixture: ComponentFixture<RegOnePage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RegOnePage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(RegOnePage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
