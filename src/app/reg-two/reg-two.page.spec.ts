import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { RegTwoPage } from './reg-two.page';

describe('RegTwoPage', () => {
  let component: RegTwoPage;
  let fixture: ComponentFixture<RegTwoPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RegTwoPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(RegTwoPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
